<?php

namespace application\core;

class RouteController {

    public $controller = '\application\core\Controller';    // Базовый контроллер
    public $settings;                                       // Настройки плагинов
    public $info = [];                                      // Параметры
    public $pagination = [];                                // Пагинация
    public $errors = [                                      // Коды ошибок
        '0' => 'отсутствует файл настроек плагинов: ',
        '1' => 'Некорректно заполнены настройки плагина: ',
        '2' => 'отсутствует файл контроллера плагина: ',
        '3' => 'отсутствует класс контроллера плагина: '
    ];

    public function __construct() {

        // Определение маршрута

        $this->info['url'] = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

        // Определение пути, проверка пагинации и плагинов

        if($this->createInfo($this->info['url']) != 'main' and P_MODE and $this->getSettings()) $this->checkPlugin($this->info['url']);

        $this->pagination();

        new $this->controller($this->info);                   // Запуск конструктора базового контроллера

        $this->settings = $this->controller = $this->info = $this->pagination = $this->errors = null;
    }

    // Определение пути и проверка пагинации

    public function createInfo($url) {

        $last = $url[count($url) - 1];
        $address = $url;

        if(preg_match('/^[\d]+$/', $last)) {

            $address[count($address) - 1] = '';
            $this->pagination['this'] = $last;
            $method = ($url['0'] == $last) ? 'main' : $url[count($url) - 2];

        } else {

            $address[] = '';
            $this->pagination['this'] = 1;
            $method = ($url['0'] == '') ? 'main' : $last;
        }

        $this->info['method'] = 'get' . ucfirst($method);
        $this->pagination['address'] = implode('/', $address);

        return $this->info['path'] = ($method == 'main') ? 'main' : $url['0'];
    }

    // Получение настроек плагинов

    public function getSettings() {

        $ds = DIRECTORY_SEPARATOR;
        $file = $_SERVER['DOCUMENT_ROOT'] . $ds . 'plugins' . $ds . 'settings.php';

        if(D_MODE) {
            try {
                if(!file_exists($file)) throw new \Exception($this->errors[0] . $file);
            } catch(\Exception $e) {
                logError($e, 0);
            }
        }

        $this->settings = require_once $file;
        return true;
    }

    // Поиск плагина

    public function checkPlugin($url) {

        foreach($this->settings['pages'] as $name => $options) {

            // Плагин включен и корректно настроен

            if($options['status']) {

                if(D_MODE) {
                    try {
                        if(!isset($options['routes']['entities']) or !isset($options['routes']['level']) or !isset($options['options'])) throw new \Exception($this->errors[1] . $name);
                    } catch(\Exception $e) {
                        logError($e, 0);
                    }
                }

                foreach($options['routes']['entities'] as $route) {

                    if($route == $url[$options['routes']['level']]) {

                        $file = 'plugins/' . $name . '/PluginController.php';
                        $class = '\plugins\\' .  $name . '\PluginController';

                        if(D_MODE) {
                            try {
                                if(!file_exists($file)) throw new \Exception($this->errors[2] . $file);
                                if(!class_exists($class)) throw new \Exception($this->errors[3] . $class);
                            } catch(\Exception $e) {
                                logError($e, 0);
                            }
                        }

                        $this->info['plugin'] = $name;
                        $this->info['plugin_settings'] = $options['options'];
                        $this->controller = $class;
                    }
                }
            }
        }
    }

    // Пагинация

    public function pagination() {

        $pagination = $this->pagination['this'];
        $address = $this->pagination['address'];

        $this->info['pagination']['this'] = $pagination;

        $this->info['pagination']['previous'] = ($pagination == 1) ? false : $address . ($pagination - 1);
        $this->info['pagination']['next'] = $address . ($pagination + 1);
    }
}