<?php

class Application extends AjaxModel {
    
    protected $uInfo;
    protected $pInfo;     
    
    // Получение данных авторизовнного пользователя
    
    function getUserInfo() {

        // Получение имени голосующего пользователя по данным, хранящимся в куки

        $user['name'] = explode('+', $_COOKIE['name'])[0];

        // Получение списка id постов, за которые уже проголосовал авторизованный пользователь

        $getUser = $this->connection->prepare("SELECT id, vote FROM users WHERE `name` = :name");
        $getUser->execute($user);
        $this->uInfo = $getUser->fetch(PDO::FETCH_ASSOC);
    }
    
    // Получение среднего рейтинга поста и списка проголосовавших userId за пост из данных, хранящихся в URI изображения этого поста
    
    function getPostInfo() {

        $prepare['name'] = explode('/', $_POST['URI'])[4];             // Имя владельца каталога с изображениями
        $prepare['postId'] = explode('/', $_POST['URI'])[6];           // Имя папки поста, совпадающее с id поста, хранящегося в БД

        $getVoters = $this->connection->prepare("SELECT id, rating, voters FROM articles WHERE `name` = :name and `postId` = :postId");
        $getVoters->execute($prepare);
        $this->pInfo = $getVoters->fetch(PDO::FETCH_ASSOC);
    }

    // Показ среднего рейтинга каждого поста, число проголосовавших и опционально оценку авторизованного пользователя

	public function showRating() {

        $data = 'DB';
        $this->getPostInfo();             // Запрос рейтинга поста

        // Если это авторизованный пользователь, то показ его оценок

        if(isset($_COOKIE['name'])) {

            $this->getUserInfo();        // Запрос данных авторизованного пользователя

            // Данные хранятся в виде: postId-оценка,postId-оценка,postId-оценка

            $search = '#(^' . $this->pInfo['id'] . '-.|,' . $this->pInfo['id'] . '-.)#';

            // Поиск postId среди коллекции постов, за которые пользователь уже голосовал

            if(preg_match($search, $this->uInfo['vote'], $match)) $data = explode('-', $match[0])[1];
        }

        echo $this->pInfo['rating'] . '+' . $data;
	}

    // Единая точка входа для проверки действий авторизованного пользователя

    public function checkVoter() {
        
	// Метод содержит не описанную здесь, более сложную проверку пользователя 
	    
        if(isset($_COOKIE['userName'])) {
            $method = $_POST['method'];
            $this->$method(); 
        } else {
            echo 'unregistered';
        }
    }

    // Внесение изменение в БД.

    public function changeRating() {

        $this->getUserInfo();             // Запрос данных авторизованного пользователя
        $this->getPostInfo();             // Запрос рейтинга поста

        $getRating = explode('-', $this->pInfo['rating']);              // Парсинг рейтинга поста вида: рейтинг-проголосовавших

        $search = '#(^' . $this->pInfo['id'] . '-.,|,' . $this->pInfo['id'] . '-.)#';

        if(preg_match($search, $this->uInfo['vote'], $identity)) {     // Если у пользователя в БД есть голос за этот пост

            $getVote = explode('-', trim($identity[0], ','));          // Парсинг данных пользователя вида: postId-оценка

            // В случае нажатия на свою оценку, она удаляется из БД
            
            if($getVote[1] == $_POST['vote']) {     // Удаление оценки

                // Изменения в articles

                $articlesData['rating'] = ($getRating[0] - $_POST['vote']) . '-' . ($getRating[1] - 1);

                $articlesData['voters'] = preg_replace_callback('#(^' . $this->uInfo['id'] . ',|,' . $this->uInfo['id'] . ',)#', 
                    function($match) {
                        if(preg_match('#^,#', $match[0])) return ',';       // В остальных случаях
                        else return '';                                     // Если это первая запись в БД
                    }, $this->pInfo['voters']);

                // Изменение в users

                $userData['vote'] = preg_replace($search, '', $this->uInfo['vote']);

                $show = $articlesData['rating'] . '+delete';                     // Подготовка данных для JS
 
            } else {        // Изменение оценки

                // Изменения в articles
  
                $articlesData['rating'] = ($getRating[0] - $getVote[1]) + $_POST['vote'] . '-' . $getRating[1];
                $articlesData['voters'] = $this->pInfo['voters'];         // Количество прголосовавших - без изменений

                // Изменение в users

                $userData['vote'] = preg_replace_callback($search, 
                    function($match) {
                        if(preg_match('#^,#', $match[0])) return $value = ',' . $this->pInfo['id'] . '-' . $_POST['vote'];
                        else return $value = $this->pInfo['id'] . '-' . $_POST['vote'] . ',';
                    }, $this->uInfo['vote']);

                $show = $articlesData['rating'] . '+' . $_POST['vote'];      // Данные вида: рейтинг-проголосовавших+ваша оценка
            }

        } else {        // Если это голосование без совпадений в БД

            $articlesData['rating'] = ($getRating[0] + $_POST['vote']) . '-' . ($getRating[1] + 1);

            // Внесение id в список проголосовавших конкретного поста

            if($this->pInfo['voters'] == '') $articlesData['voters'] = $this->uInfo['id'] . ',';     // Если БД пуста
            else $articlesData['voters'] = $this->pInfo['voters'] . $this->uInfo['id'] . ',';        // Конкатенация

            // Внесение записи postId-оценка голосующего пользователя

            if($this->uInfo['vote'] == '') $userData['vote'] = $this->pInfo['id'] . '-' . $_POST['vote'] . ',';
            else $userData['vote'] = $this->uInfo['vote'] . $this->pInfo['id'] . '-' . $_POST['vote'] . ',';

            $show = $articlesData['rating'] . '+' . $_POST['vote'];      // Данные вида: рейтинг-проголосовавших+ваша оценка
        }

        // Внесение данных в articles

        $articlesData['name'] = explode('/', $_POST['URI'])[4];            // Имя владельца каталога с изображениями
        $articlesData['postId'] = explode('/', $_POST['URI'])[6];     // Имя папки поста, совпадающее с id поста, хранящегося в БД

        $updateArticles = $this->connection->prepare("UPDATE `articles` SET rating=:rating, voters=:voters WHERE name = :name and postId = :postId");
        $updateArticles->execute($articlesData);

        // Внесение данных в users

        $userData['id'] = $this->uInfo['id'];

        $addNewVote = $this->connection->prepare("UPDATE `users` SET vote=:vote WHERE id = :id");
        
        $addNewVote->execute($userData);

        echo $show;                     // Показ обновлённых дагнных рейтинга
    }
}

$object = new Application;

// Метод вызывается после создания дескриптора подключения к БД, хранящегося в свойстве $connection.

if($_POST['buttonStatus'] != '') {
    $method = $_POST['buttonStatus'];
    $this->$method();
}
        
