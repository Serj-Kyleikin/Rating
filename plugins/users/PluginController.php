<?php

namespace plugins\users;

use application\core\Controller;
use application\core\Model;

class PluginController extends Controller {

    public function start($info) {

        // Маршрутизация

        if(isset($_COOKIE['user']) and $info['path'] == 'authorization' or $info['path'] == 'registration') {
            if($this->model->checkUser() == 'checked') redirect(' ');
        }

        // Получение данных модели

        return $this->model->getData($info);
    }
}