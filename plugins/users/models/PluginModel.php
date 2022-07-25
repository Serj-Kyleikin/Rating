<?php

namespace plugins\users\models;

use application\core\Model;
use PDO;

class PluginModel extends Model {

    // Страница Авторизация

    public function getAuthorization($info) {

        return '';
    }

    // Страница Регистрации

    public function getRegistration($info) {

        return '';
    }
}