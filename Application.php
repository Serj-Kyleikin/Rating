<?php

class Application extends AjaxModel {
    
    protected $userInfo;                // Данные авторизованного пользователя
    protected $postInfo;                // Данные поста
    protected $status = 'clear';        // Маркер: без команды для JS
    
    // Получение данных авторизовнного пользователя
    
    function getUserInfo() {

        // Получение имени голосующего пользователя по данным, хранящимся в куки

        $user['name'] = explode('+', $_COOKIE['name'])[0];

        // Получение списка id постов, за которые уже проголосовал авторизованный пользователь

        $getUser = $this->connection->prepare("SELECT id, vote FROM users WHERE `name` = :name");
        $getUser->execute($user);
        $this->userInfo = $getUser->fetch(PDO::FETCH_ASSOC);
    }
    
    // Получение рейтинга поста из данных, хранящихся в URI изображения этого поста
    
    function getRating() {

        $prepare['name'] = explode('/', $_POST['URI'])[4];           // Имя владельца каталога с изображениями
        $prepare['postId'] = explode('/', $_POST['URI'])[6];         // Имя папки поста, совпадающее с id поста, хранящегося в БД

        $getVoters = $this->connection->prepare("SELECT id, rating, voters FROM articles WHERE `name` = :name and `postId` = :postId");
        $getVoters->execute($prepare);
        $this->postInfo = $getVoters->fetch(PDO::FETCH_ASSOC);
    }

    // Метод показывает средний рейтинг каждого поста при загрузке страницы, а также фиксирует изменение оценки рейтинга, конкретного пользователя.

	public function showRating() {

		$this->getRating();

        // Если это авторизованный пользователь, то выполняется обработка его действий

        if(isset($_COOKIE['name'])) {
            
            $this->getUserInfo();       // Запрос данных авторизованного пользователя
        
            // Поиск postId среди коллекции постов, за которые пользователь уже голосовал

            $first = '#^' . $this->postInfo['id'] . '-#';
            $any = '#,' . $this->postInfo['id'] . '-#';

            // Данные хранятся в виде: postId-оценка,postId-оценка,postId-оценка

            if(preg_match($first, $this->userInfo['vote'], $match) or preg_match($any, $this->userInfo['vote'], $match)) {

                // Если это не удаление своей оценки, то статус получает значение оценки

                if($this->status != 'delete') {
                    preg_match('#' . $match[0] . '\d#', $this->userInfo['vote'], $match);
                    $this->status = explode('-', $match[0])[1];
                }
            }
        }

        echo $this->postInfo['rating'] . '+' . $this->status;        // JS в зависимости от маркера, отображает значение рейтинга
	}

    // Проверка статуса голосующего

    public function checkVoter() {

        if(isset($_COOKIE['name'])) {

            $this->getUserInfo();           // Запрос данных авторизованного пользователя
            $this->getRating();             // Запрос рейтинга поста

            $detection = 'new';             // Маркер: пользователь не голосовал

            // Проверка, голосовал ли пользователь за этот пост
            
            $first = '#^' . $this->postInfo['id'] . '-#';
            $any = '#,' . $this->postInfo['id'] . '-#';

            if(preg_match($first, $this->userInfo['vote'], $match) or preg_match($any, $this->userInfo['vote'], $match)) {

                // Получение: postId-оценка
                
                preg_match('#' . $match[0] . '\d#', $this->userInfo['vote'], $match);
                $detection = $match[0];
            }

            $this->changeRating($detection); 

        } else {
            echo 'unregistered';
        }
    }

    // Внесение изменение в БД.

    public function changeRating($detection) {
        
        $prepare['name'] = explode('/', $_POST['URI'])[4];             // Имя владельца каталога с изображениями
        $prepare['postId'] = explode('/', $_POST['URI'])[6];     // Имя папки поста, совпадающее с id поста, хранящегося в БД

        $getRating = explode('-', $this->postInfo['rating']);

        $vote = explode(',', $this->userInfo['vote']);
        $voters = explode(',', $this->postInfo['voters']);

        // Если у пользователя в БД нет голоса за этот пост

        if($detection == 'new') {

            $prepare['rating'] = ($getRating[0] + $_POST['vote']) . '-' . ($getRating[1] + 1);

            // Внесение id в список проголосовавших конкретного поста

            if(count($voters) == 1) {                                   // Если в БД нет проголосоваших
                $prepare['voters'] = $this->userInfo['id'] . ',';
            } elseif($voters[1] == '') {                                // Если в БД один проголосовавший

                foreach($voters as $key => $voter) {

                    $newVoters[$key] = $voter;
                    
                    if($key == 1) $newVoters[$key] = $this->userInfo['id'];
                }

                $prepare['voters'] = implode(',', $newVoters) . ',';

            } elseif(count($voters) > 2) {                              // Если в БД больше одного проголосовавшего

                foreach($voters as $key => $voter) {

                    if($key == (count($voters) - 1)) $newVoters[$key] = $this->userInfo['id'];
                    else $newVoters[$key] = $voter;
                }

                $prepare['voters'] = implode(',', $newVoters)  . ',';
            }

            // Внесение записи postId-оценка голосующего пользователя
            
            if(count($vote) == 1) {                                           // Если пользователь ещё не голосовал
                $formVote = $this->postInfo['id'] . '-' . $_POST['vote'] . ',';
            } elseif($vote[1] == '') {                                        // Если пользовал голосовал один раз

                foreach($vote as $key => $value) {

                    $newVote[$key] = $value;

                    if($key == 1) $newVote[$key] = $this->postInfo['id'] . '-' . $_POST['vote'];
                }

                $formVote = implode(',', $newVote);

            } else {                                                          // В остальных случаях

                array_push($vote, $this->postInfo['id'] . '-' . $_POST['vote']);
                $formVote = implode(',', $vote);
            }

        } else {            // В случае измененения оценки или её удаления

            $getVote = explode('-', $detection);

            if($getVote[1] == $_POST['vote']) {     // Удаление оценки

                $prepare['rating'] = ($getRating[0] - $_POST['vote']) . '-' . ($getRating[1] - 1);
                
                // Изменение voters

                foreach($voters as $key => $value) if($value == $this->userInfo['id']) unset($voters[$key]);
                
                if(count($voters) == 0) $prepare['voters'] = '';
                else $prepare['voters'] = implode(',', $voters);

                // Изменение votes

                foreach($vote as $key => $value) {
                    
                    $getValue = explode('-', $value);
                    
                    if($getValue[0] == $this->postInfo['id'])  unset($vote[$key]);
                }

                $formVote = implode(',', $vote);

                $status = 'delete';
 
            } else {        // Изменение оценки
       
                $prepare['rating'] = ($getRating[0] - $getVote[1]) + $_POST['vote'] . '-' . $getRating[1];
                $prepare['voters'] = $this->postInfo['voters'];

                // Изменение votes

                foreach($vote as $key => $value) {
                    
                    $getValue = explode('-', $value);
                    
                    if($getValue[0] == $this->postInfo['id']) $vote[$key] = $this->postInfo['id'] . '-' . $_POST['vote'];
                }
                
                $formVote = implode(',', $vote);
            }
        }

        // Внесение данных в articles

        $updateArticles = $this->connection->prepare("UPDATE `articles` SET rating=:rating, voters=:voters WHERE name = :name and postId = :postId");
        $updateArticles->execute($prepare);
        
        // Внесение данных в users

        $data['id'] = $this->userInfo['id'];
        $data['vote'] = $formVote;

        $addNewVote = $this->connection->prepare("UPDATE `users` SET vote=:vote WHERE id = :id");
        
        $addNewVote->execute($data);
        
        // Показ рейтинга
        
        $this->showRating();
    }
}

$object = new Application;      // Объект создаётся в AjaxController MVC-фреймворка

// Метод вызывается из родительского класса AjaxModel, после создания дескриптора подключения к БД, хранящегося в свойстве $connection.

if($_POST['buttonStatus'] != '') {
    $method = $_POST['buttonStatus'];
    $this->$method();
}
        