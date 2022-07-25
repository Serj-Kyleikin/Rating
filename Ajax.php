<?php

use libraries\Log;

// Настройки администратора (0 - публичное размещение, 1 - отладка)

ini_set('display_errors', 0);       // Отображение ошибок
error_reporting(E_ALL);

define('A_MODE', 1);                // Режим администратора
define('C_MODE', 0);                // Режим диагностики
define('D_MODE', 0);                // Режим диагностики

if(A_MODE) require_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/Admin.php';

// Загрузка модели

if(isset($_POST['ajaxSettings'])) {

    // Логирование ошибок

    require_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/Log.php';
    $log = new Log;

    $errors = [
        '0' => 'отсутствует файл плагина AJAX-модели ',
        '1' => 'отсутствует класс AjaxModel в ',
        '2' => ' - ajax-метод отсутствует в модели: ',
    ];

    // Загрузка модели

    require_once $_SERVER['DOCUMENT_ROOT'] . '/application/core/Model.php';

    $settings = explode(':',$_POST['ajaxSettings']);

    if($settings[0] == 'plugins') {

        $file = $_SERVER['DOCUMENT_ROOT'] . '/plugins/' . $settings[1] . '/models/AjaxModel.php';
        $path = '\plugins\\' . $settings[1] . '\models\AjaxModel';

    } else {

        $file = $_SERVER['DOCUMENT_ROOT'] . '/application/models/ajax/' . $settings[1] . 'Model.php';
        $path = '\application\models\ajax\\' . $settings[1] . 'Model';
    }

    try {

        if(!file_exists($file)) throw new \Exception($errors[0] . $file);
        else require_once $file;

        if(!class_exists($path)) throw new \Exception($errors[1] . $file);
        else {

            $model = new $path('ajax');
            $method = $settings[2];

            if(!method_exists($model, $method)) throw new \Exception($method . $errors[2] . $path);
            else $model->$method();
        }

    } catch(\Exception $e) {
        $log->logErrors($e, 0);
    }

} else {
    header('location: /');
}