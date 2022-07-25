<?php

namespace libraries\configuration;

use PDO;

if(count($_POST) == 4) {

    $ds = DIRECTORY_SEPARATOR;
    $path = $_SERVER['DOCUMENT_ROOT'] . $ds;

    // Создание папок

    $dirs = require_once $path . 'admin/configuration/dirs.php';

    foreach($dirs as $type) {
        foreach($type as $access => $catalogs) {
            foreach($catalogs as $catalog) {
                $dir = $path . $catalog;
                if(!is_dir($dir)) mkdir($dir, base_convert($access, 8, 10), True);
            }
        }
    }

    // Создание файлов

    $files = require_once $path . 'admin/configuration/files.php';

    foreach($files as $type) {
        foreach($type as $access => $file_t) {
            foreach($file_t as $file => $data) {

                if($file == 'configurations/connection.php') {     // Создание дескриптора подключения

                    $data = "<?php

                    return [
                        'host' => '{$_POST['host']}',
                        'db_name' => '{$_POST['base']}',
                        'password' => '{$_POST['password']}',
                        'user' => '{$_POST['login']}'
                    ];";

                } elseif($file == '.htaccess') $data = require_once $path . 'admin/configuration/apache.php';

                $file = $path . $file;
                if(!is_file($file)) file_put_contents($file, $data);
                chmod($file, base_convert($access, 8, 10));
            }
        }
    }

    // Подготовка модели

    $start = new PDO("mysql:host={$_POST['host']}", "{$_POST['login']}", "{$_POST['password']}");
    $query = "CREATE DATABASE IF NOT EXISTS {$_POST['base']} CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    $start->exec($query);

    $descriptor = new PDO('mysql:host='.$_POST['host'].';dbname='.$_POST['base'].'', $_POST['login'], $_POST['password'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    $descriptor->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Создание таблиц

    $tables = require_once $path . 'admin/configuration/tables.php';

    foreach($tables as $type) {
        foreach($type as $table) $descriptor->exec($table);
    }

    // Загрузка контента

    $content = require_once $path . 'admin/configuration/content.php';

    foreach($content as $type) {
        foreach($type as $insert) $descriptor->exec($insert);
    }

} else {
    header('location: /installation.php');
}