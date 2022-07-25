<?

namespace plugins\users\models;

use application\core\Model;
use PDO;

class AjaxModel extends Model {

    public $info;

    //**************************// Авторизация //**************************//

    public function authorization() {
		$this->getUser();
        echo (!empty($this->info)) ? $this->checkPassword() : 'wrong_a_login';
    }

    // Получение данных пользователя

    public function getUser() {

        $login['login'] = htmlspecialchars($_POST['login']);

        try {

            $get = $this->connection->prepare('SELECT id, password_hash, user_id, attempts, date FROM plugin_users_registered as r JOIN plugin_users_secure as s ON r.id = s.user_id WHERE r.login =:login');
            $get->execute($login);
            $this->info = $get->fetch(PDO::FETCH_ASSOC);

        } catch(\PDOException $e) {
            $this->log->logErrors($e, 1);
        }
    }

    // Проверка пароля

    public function checkPassword($status = []) {

        if($this->info['attempts'] == 3 and $status != 'retry') $response = $this->checkAttempts();
        else $response = (password_verify($_POST['password'], $this->info['password_hash'])) ? 'verify' : 'wrong_a_password';

        if($response == 'wrong_a_password') {

            $response = ($status == 'retry') ? $this->updateAttempts(1, '2') : $this->checkAttempts();

        } elseif($response == 'verify') {

            $prepare['user_id'] = $this->info['id'];
            $prepare['secret'] = bin2hex(random_bytes(14));
            $prepare['attempts'] = null;
            $prepare['date'] = null;

            try {

                $insert = $this->connection->prepare("UPDATE `plugin_users_secure` SET secret=:secret, attempts=:attempts, date=:date WHERE user_id=:user_id");
                $insert->execute($prepare);

            } catch(\PDOException $e) {
                $this->log->logErrors($e, 1);
            }

            $key = rand(10, 99) . (int)$this->info['id'] . rand(10, 99);
            $personal_id = (int)$key * 3 . rand(10, 99);

            $this->setCookie($personal_id . '_' . $prepare['secret']);
            $this->saveLog();
        }

        return $response;
    }

    // Проверка статуса неудачной попытки

    public function checkAttempts() {

        if($this->info['attempts'] != '') {

            if($this->info['attempts'] == 1) $response = $this->updateAttempts(2, '1');
            elseif($this->info['attempts'] == 2) $response = $this->updateAttempts(3, '0');
            else $response = (time() - strtotime($this->info['date']) > 3600) ? $this->checkPassword('retry') : 'password_blocked';

        } else $response = $this->updateAttempts(1, '2');

        return $response;
    }

    // Внесение неудачной попытки

    public function updateAttempts($attempts, $response) {

        $check['user_id'] = $this->info['id'];
        $check['attempts'] = $attempts;

        try {

            $sentLimit = $this->connection->prepare("UPDATE `plugin_users_secure` SET attempts=:attempts, date=NOW() WHERE user_id=:user_id");
            $sentLimit->execute($check);

        } catch(\PDOException $e) {
            $this->log->logErrors($e, 1);
        }

        if($response == '0') $response = 'blocked';

        return "password_{$response}";
    }


    //**************************// Регистрация //**************************//

    public function registration() {

        if($this->checkData()) {

            // Добавление нового пользователя

            $user['login'] = htmlspecialchars($_POST['login']);
            $user['password'] = htmlspecialchars($_POST['password']);
            $user['password_hash'] = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

            try {

                $this->connection->beginTransaction();
                $this->connection->exec("LOCK TABLES plugin_users_registered WRITE, plugin_users_personal WRITE, plugin_users_secure WRITE");

                $saveUser = $this->connection->prepare('INSERT INTO plugin_users_registered (login, password, password_hash) VALUES(:login, :password, :password_hash)');
                $saveUser->execute($user);
                $id = $this->connection->lastInsertId();

            } catch(\PDOException $e) {
                $this->log->logErrors($e, 1);
            }

            // Добавление персональных данных нового пользователя

            $personal['user_id'] = $id;
            $personal['name'] = $_POST['name'];
            $personal['mail'] = $_POST['mail'];

            try {

                $saveMail = $this->connection->prepare('INSERT INTO plugin_users_personal(user_id, name, mail) VALUES(:user_id, :name, :mail)');
                $saveMail->execute($personal);

            } catch(\PDOException $e) {
                $this->log->logErrors($e, 1);
            }

            // Добавление проверочных данных нового пользователя

            $secure['secret'] = bin2hex(random_bytes(14));
            $secure['user_id'] = $id;

            try {

                $saveSecure = $this->connection->prepare('INSERT INTO plugin_users_secure (user_id, secret) VALUES(:user_id, :secret)');
                $saveSecure->execute($secure);
                $this->connection->commit();

                $this->connection->exec("UNLOCK TABLES");

            } catch(\PDOException $e) {
                $this->log->logErrors($e, 1);
            }

            // Запись лога и присвоение куки

            $key = rand(10, 99) . (int)$id . rand(10, 99);
            $personal_id = (int)$key * 3 . rand(10, 99);

            $this->setCookie($personal_id . '_' . $secure['secret']);
            $this->saveLog();

            echo 'verify';
        }
    }

    // Проверка почты и логина при регистрации

    public function checkData() {

        $user['login'] = htmlspecialchars($_POST['login']);
        $personal['mail'] = htmlspecialchars($_POST['mail']);

        try {

            $checkLogin = $this->connection->prepare('SELECT login FROM plugin_users_registered WHERE login=:login');
            $checkLogin->execute($user);

            $login = $checkLogin->fetch(PDO::FETCH_ASSOC);

            $checkMail = $this->connection->prepare('SELECT mail FROM plugin_users_personal WHERE mail=:mail');
            $checkMail->execute($personal);

            $mail = $checkMail->fetch(PDO::FETCH_ASSOC);

        } catch(\PDOException $e) {
            $this->log->logErrors($e, 1);
        }

        if($login == '' and $mail == '') return true;
        elseif($mail != '') echo 'wrong_r_mail';
        elseif($login != '') echo 'wrong_r_login';
    }


    //**************************// Вспомогательные методы //**************************//

    // Запись данных авторизованного пользователя

    public function saveLog() {

        if($_POST['info'] == '"TypeError"') {
            $log = 'Сайт https://json.geoiplookup.io/ работает с ошибкой, поэтому данные авторизующегося пользователя не получить.';
            $code = 1;
        } else {
            $log = $_POST['info'];
            $code = 0;
        }

        $this->log->logPlugin($log, $code);
    }

    // Добавление Куки

    public function setCookie($value) {

        $cookie = [
            'expires' => time()+60*60*24*365*1,
            'path' => '/',
            'domain' => '',
            'secure' => false,
            'httponly' => true
        ];

        setcookie('user', $value, $cookie);
    }
}