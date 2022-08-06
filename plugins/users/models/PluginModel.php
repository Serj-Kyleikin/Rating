<?php

namespace plugins\users\models;

use application\core\Model;
use PDO;

class PluginModel extends Model {

    // Страница Авторизация

    public function getAuthorization($info) {

        if($info['pagination']["this"] == '1') $result['content'] = 0;
        else $result['empty'] = true;

        return $result;
    }

    // Страница Регистрации

    public function getRegistration($info) {

        if($info['pagination']["this"] == '1') $result['content'] = 0;
        else $result['empty'] = true;

        return $result;
    }
}