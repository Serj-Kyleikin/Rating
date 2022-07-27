<?

namespace application\models;

use application\core\Model;
use PDO;

class MainModel extends Model {

    // Главная страница

    public function getMain($info) {

        // Параметры пагинации

        $result['pagination'] = $this->setPagination($info['url'], $info['pagination']);

        $from = ($info['pagination'] == 1) ? 0 : ($info['pagination'] - 1) * $this->pagination;

        // Статьи

        try {

            $getInfo = $this->connection->prepare('SELECT id, text FROM articles ORDER BY id DESC LIMIT :from, :limit');
            $getInfo->bindValue(':from', $from, PDO::PARAM_INT);
            $getInfo->bindValue(':limit', $this->pagination, PDO::PARAM_INT); 
            $getInfo->execute();
            $result['static'] = $getInfo->fetchAll(PDO::FETCH_ASSOC);

        } catch(\PDOException $e) {
            logError($e, 1);
        }
        
        if($result['static']) {

            // Поиск первой статьи из БД в выдаче

            try {

                $getId = $this->connection->prepare('SELECT id FROM articles ORDER BY id LIMIT 1');
                $getId->execute();
                $min = $getId->fetch(PDO::FETCH_ASSOC);

            } catch(\PDOException $e) {
                logError($e, 1);
            }

            foreach($result['static'] as $article) if($article['id'] == $min['id']) $result['pagination']['next'] = false;

            // Подгрузка динамического контента

            $result['dynamic']['options'] = $from;
            $result['dynamic']['content'] = $this->getMainDynamic($from);

        } else {

            if(!$from) $result['pagination']['next'] = false;       // Нет записей для первой страницы в пагинации
            else $result['static']['empty'] = true;                 // Отсутствуют данные для пагинации
        }

        return $result;
    }

    // Динамичный контент главной страницы

    public function getMainDynamic($from) {

        if(isset($_COOKIE['user'])) {

            $sql = "SELECT id, r.article_id as votes_articleID, rating, voters, user_id, u.article_id as voters_articleID, vote FROM articles as a LEFT JOIN rating_votes as r ON a.id = r.article_id LEFT JOIN rating_voters as u ON r.article_id = u.article_id and u.user_id=:user_id ORDER BY a.id DESC LIMIT :from, :limit";

        } else $sql = "SELECT id, article_id, rating, voters FROM articles as a LEFT JOIN rating_votes as r ON a.id = r.article_id ORDER BY a.id DESC LIMIT :from, :limit";

        // Рейтинг постов

        try {

            $getInfo = $this->connection->prepare($sql);

            $getInfo->bindValue(':from', $from, PDO::PARAM_INT);
            $getInfo->bindValue(':limit', $this->pagination, PDO::PARAM_INT); 
            if(isset($_COOKIE['user'])) $getInfo->bindValue(':user_id', (int)$this->getID());

            $getInfo->execute();
            $result = $getInfo->fetchAll(PDO::FETCH_ASSOC);

        } catch(\PDOException $e) {
            logError($e, 1);
        }

        return $result;
    }
}
