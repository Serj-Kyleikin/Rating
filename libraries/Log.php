<?php

namespace libraries;

class Log {

    public $settings = [
        'mail_alert' => false,
        'admin_mail' => 'admin@mail.ru'
    ];

    public $code_files = [
        '0' => 'diagnostic_errors.txt',   // Ошибки при диагностики
        '1' => 'db_errors.txt',           // Ошибки базы данных
        '2' => 'resourse_errors.txt'      // Отсутствие ресурсов
    ];

    public $code_plugins = [
        '0' => 'plugins/users/authorizations.txt',
        '1' => 'plugins/users/errors.txt'
    ];

    // Запись логов

    public function write($data, $code) {

        $path = (gettype($code) == 'integer') ? $this->code_files[$code] : $code;

        $ds = DIRECTORY_SEPARATOR;
        $file = $_SERVER['DOCUMENT_ROOT'] . $ds . 'logs' . $ds . $path;
        $date = '*************' . date('[Y-m-d H:i:s] ') . '*************';

        file_put_contents($file, PHP_EOL . $date, FILE_APPEND | LOCK_EX);
        file_put_contents($file, PHP_EOL . $data . PHP_EOL, FILE_APPEND);

        if($this->settings['mail_alert'] === true) mail($this->settings['admin_mail'], 'Обнаружена ошибка', $message);
    }

    // Логирование данных плагина

    public function logPlugin($log, $code) {
        $this->write($log, $this->code_plugins[$code]);
    }

    // Логирование системных ошибок

    public function logErrors($catch, $code) {

        $error = "Ошибка: " . $catch->getMessage() . PHP_EOL;
        $file = "Ошибка в файле: " . $catch->getFile() . PHP_EOL;
        $string = "В строке: " . $catch->getLine() . PHP_EOL;

        $log =  $error . $file . $string;

        $this->write($log, $code);
    }

    // Отсутствие медиа-ресурсов в файлах

    public function logResourseError($catch, $code) {

        $error = $catch . $_SERVER['REQUEST_URI']. PHP_EOL;
        $file = "Ошибка в файле: " . $_SERVER['HTTP_REFERER'] . PHP_EOL;

        $log = $error . $file;

        $this->write($log, $code);
    }

    // Логирование отсутствующих в шаблоне модулей

    public function logComponentError($catch, $code) {

        $error = "Ошибка: отсутствует " . $catch->getMessage() . PHP_EOL;
        $page = "На странице: " . $_SERVER['REQUEST_URI'] . PHP_EOL;
        $file = "Ошибка в файле: " . $catch->getFile() . PHP_EOL;
        $string = "В строке: " . $catch->getLine() . PHP_EOL;

        $log =  $error . $page . $file . $string;

        $this->write($log, $code);
    }
}