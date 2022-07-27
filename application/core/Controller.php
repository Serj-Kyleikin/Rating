<?php

namespace application\core;

use application\core\Model;
use application\core\View;

class Controller {

    protected $model;               // Объект модели

    public $resourse_dirs = [       // Директории с ресурсами для проверки на битые ссылки
        'public',
        'plugins'
    ];

    public $errors = [
        '0' => 'отсутствует класс модели: ',
        '1' => 'Отсутствует ресурс: ',
        '2' => 'отсутствует start() в плагине: '
    ];

    public function __construct($info) {

        // Создание модели

        if(isset($info['plugin'])) {
            $entity['file'] = 'plugins/' . $info['plugin'] . '/models/PluginModel.php';
            $entity['class'] = '\plugins\\' .  $info['plugin'] . '\models\PluginModel';
        } else {
            $entity['file'] = 'application/models/' . ucfirst($info['path']) . 'Model.php';
            $entity['class'] = '\application\models\\' . ucfirst($info['path']) . 'Model';
        }

        $this->createModel($entity);

        // Получение данных модели

        $info['method'] = 'get' . ucfirst($info['path']);

        if(method_exists($this->model, $info['method'])) {

            if(isset($info['plugin'])) {

                if(D_MODE) {
                    try {
                        if(!method_exists($this, 'start')) throw new \Exception($this->errors[2] . $info['plugin']);
                    } catch(\Exception $e) {
                        logError($e, 0);
                    }
                }

                $data = $this->start($info);                    // Запуск контроллера плагина

            } else $data = $this->model->getData($info);

            if(isset($data['static']['empty'])) redirect(true);   // При отсутствии данных для пагинации и иных параметров URL

            // Запуск рендеринга

            $view = new View;
            $view->rendering($info, $data);                     // Запуск сборки страницы

            $this->errors = $this->resourse_dirs = $this->model = null;

        } else redirect(true);                                  // Страницы не существует
    }

    // Проверка файлов и классов. Создание модели.

    public function createModel($entity) {

        if(file_exists($entity['file'])) {

            if(D_MODE) {
                try {
                    if(!class_exists($entity['class'])) throw new \Exception($this->errors[0] . $entity['class']);
                } catch(\Exception $e) {
                    logError($e, 0);
                }
            }

            $this->model = new $entity['class'];

        } else {

            if(C_MODE) {

                // Логирование битых ссылок на изображения

                foreach($this->resourse_dirs as $dir) {
                    if(explode('/', $entity['file'])[2] == ucfirst($dir) . 'Model.php') {
                        logError($this->errors[1], 'Resourse');
                    }
                }
            }

            redirect(true);                                 // Страницы не существует
        }
    }
}
