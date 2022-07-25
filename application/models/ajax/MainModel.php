<?

namespace application\models\ajax;

use application\core\Model;
use PDO;

class MainModel extends Model {

    // Добавить оценку

    public function addRating() {
        echo $this->prepareRating();
    }

    // Проверка на ошибки при добавление оценки

    public function prepareRating() {

        if(strlen($_POST['vote']) == 1 and $_POST['vote'] <= 5) {               // Проверка на читерство

            if(isset($_COOKIE['user'])) {

                // Проверка голосовал ли пользователь

                $id['user_id'] = $this->getID();
                $id['article_id'] = $_POST['article_id'];

                try {

                    $getInfo = $this->connection->prepare('SELECT user_id, r.article_id as votes_articleID, vote, u.article_id as voters_articleID, rating, voters FROM rating_votes as r LEFT JOIN rating_voters as u ON r.article_id = u.article_id and u.user_id=:user_id WHERE r.article_id=:article_id ORDER BY r.article_id DESC, u.user_id LIMIT 1');
                    $getInfo->execute($id);
                    $info = $getInfo->fetch(PDO::FETCH_ASSOC);

                } catch(\PDOException $e) {
                    $this->log->logErrors($e, 1);
                }

                if($info == null or $info['user_id'] == NULL) {                  // Не голосовал за этот пост ранее

                    if($info['votes_articleID'] == $_POST['article_id']) {       // Обновление рейтинга

                        $vote['article_id'] = $id['article_id'];
                        $vote['voters'] = (int)$info['voters'] + 1;

                        $rating = (int)$info['rating'] / 100;
                        $full = (int)$rating * (int)$info['voters'];
                        $sum = (int)$full + (int)$_POST['vote'];
                        $new_rating = round((int)$sum / (int)$vote['voters'], 2);
                        $vote['rating'] = $new_rating * 100;

                        $sql = "UPDATE rating_votes SET rating=:rating, voters=:voters WHERE article_id=:article_id";
                        $response = $new_rating . '_' . $vote['voters'];

                    } else {                                                    // Первая запись в рейтинг

                        // Проверка наличия поста с таким id

                        try {

                            $check['article_id'] = $_POST['article_id'];

                            $checkArticle = $this->connection->prepare('SELECT id FROM articles WHERE id=:article_id ORDER BY id DESC LIMIT 1');
                            $checkArticle->execute($check);
                            $check_article = $checkArticle->fetch(PDO::FETCH_ASSOC);
                            
                        } catch(\PDOException $e) {
                            $this->log->logErrors($e, 1);
                        }

                        if($check_article != null) {

                            $vote['article_id'] = $id['article_id'];
                            $vote['voters'] = 1;
                            $vote['rating'] = (int)$_POST['vote'] * 100;

                            $sql = "INSERT INTO rating_votes(article_id, voters, rating) VALUES(:article_id, :voters, :rating)";
                            $response = $_POST['vote'] . '_1';

                        } else return 2;          // Зафиксирована попытка добавить рейтинг к несуществующему посту
                    }

                    // Внесение данных

                    $voters['user_id'] = $id['user_id'];
                    $voters['article_id'] = $id['article_id'];
                    $voters['vote'] = $_POST['vote'];

                    try {

                        $this->connection->beginTransaction();
                        $this->connection->exec("LOCK TABLES rating_voters WRITE, rating_votes WRITE");

                        // Добавление проголосовавшего

                        $addVoter = $this->connection->prepare("INSERT INTO rating_voters(user_id, article_id, vote) VALUES(:user_id, :article_id, :vote)");
                        $addVoter->execute($voters);

                        // Добавление рейтинга

                        $addRating = $this->connection->prepare($sql);
                        $addRating->execute($vote);

                        $this->connection->commit();
                        $this->connection->exec("UNLOCK TABLES");

                    } catch(\PDOException $e) {
                        $this->log->logErrors($e, 1);
                    }

                } else return 1;            // Повторное голосование

            } else return 0;                // Неавторизованный пользователь

            return $response;

        } else return 2;                    // Зафиксирована попытка обмана
    }
}