<?php

namespace libraries;

class Cache {

    public $ds = DIRECTORY_SEPARATOR;

    // Кэширование

    public function read($cache) {

        $file = $_SERVER['DOCUMENT_ROOT'] . $this->ds . 'cache' . $this->ds . $cache;

        if(file_exists($file)) {
            $data = file_get_contents($file);
            return unserialize($data);
        } else return null;
    }

    // Чтение кэша

    public function write($cache, $data) {
        $file = $_SERVER['DOCUMENT_ROOT'] . $this->ds . 'cache' . $this->ds . $cache;
        file_put_contents($file, serialize($data));
    }

    // Удаление кэша

    public function delete($cache) {
        $file = $_SERVER['DOCUMENT_ROOT'] . $this->ds . 'cache' . $this->ds . $cache;
        if(file_exists($file)) unlink($file);
    }
}