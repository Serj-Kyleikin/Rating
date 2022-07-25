<?php

use libraries\Log;

session_start();

// Настройки администратора (0 - публичное размещение, 1 - отладка)

ini_set('display_errors', 0);       // Отображение ошибок
error_reporting(E_ALL);

define('A_MODE', 0);                // Режим администратора
define('C_MODE', 0);                // Режим проверки
define('D_MODE', 0);                // Режим диагностики
define('P_MODE', 1);                // Использование плагинов

// Подключение технических функций администратора на время работ

if(A_MODE) require_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/Admin.php';

// Автозагрузка классов

spl_autoload_register(function($class) {

    $ds = DIRECTORY_SEPARATOR;
    $path = $_SERVER['DOCUMENT_ROOT'] . $ds . str_replace('\\', $ds, $class) . '.php';

    addClass($path);
});

// Загрузка класса

function addClass($path) {

    if(D_MODE) {
        try {
            if(!file_exists($path)) throw new \Exception('отсутствует файл с классом: ' . $path);
        } catch(\Exception $e) {
            logError($e, 0);
        }
    }

    require $path;
}

// Логирование ошибок

function logError($catch, $type, $show = true) {

    $log = new Log;

    if(gettype($type) != 'integer') {
        $method = 'log' . $type . 'Error';
        $type = 2;
    } else $method = 'logErrors';

    $log->$method($catch, $type);

    redirect($show);
}

// Рекдирект

function redirect($url) {

    if($url === true) header('location: /404.php');
    elseif($url == 'insert') echo "window.location.href = '/404.php';";
    elseif($url == 'script') echo "<script>window.location.href = '/404.php';</script>";
    else header('location: /' . $url);

    if($url != 'insert') exit;
}

// Запуск маршрутизатора

$routeController = '\application\core\RouteController';
new $routeController;
