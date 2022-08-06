<?php

namespace application\core;

class View {

    public $settings;
    public $scripts = [];
    public $styles = [];
    public $header = 'public/css/partials/header.min.css';
    public $partials = [];
    public $icons = [];
    public $size = 0;
    public $time = 0;

    // Подготовка компонентов, стилей и скриптов страницы

    public function rendering($info, $data) {

        // Подготовка контента страницы

        if(isset($info['plugin'])) {
            $contentPath = 'plugins/' . $info['plugin'] . '/view/';
            $stylePath =  'plugins/' . $info['plugin'] . '/styles/';
            $scriptPath = 'plugins/' . $info['plugin'] . '/scripts/';
        } else {
            $contentPath = 'application/view/pages/';
            $stylePath = 'public/css/pages/';
            $scriptPath = 'public/js/';
        }

        // Подготовка данных страницы

        $this->icons = $data['settings']['icons'];

        $this->time = (isset($data['settings']['performance'])) ? $data['settings']['performance'] : $data['settings']['icons']['count'];

        foreach($data['settings']['meta'] as $key => $name) if($key != 'scripts') $this->settings[$key] = $name;

        // Подготовка скриптов JS для загрузки в каркасе

        if($data['settings']['meta']['scripts'] != '') {
            $scripts = explode(',', $data['settings']['meta']['scripts']);
            foreach($scripts as $script) if($script != '') $this->scripts[] = $scriptPath  . $script;
        }

        unset($data['settings']);

        // Подготовка стилей для загрузки в каркасе

        $this->styles[] = $stylePath . $info['path'] . '.css';

        // Подготовка модулей страницы для загрузки в каркасе

        $this->partials['header'] = 'application/view/partials/header.php';
        $this->partials['content'] = $contentPath . $info['path'] . '.php';

        // Подготовка контента страницы

        $page[0] = $data;
        $route = $plugin = $data = $info = null;

        $page[] = ob_get_clean();

        // Загрузка каркаса

        $file = 'application/view/gather.php';

        if(D_MODE) $this->check('шаблона', $file);
        include_once $file;

        $this->settings = $this->scripts = $this->styles = $this->header = $this->partials = $this->icons = $this->size = $this->time = null;
    }

    // Загрузка стилей CSS

    public function loadCSS($type) {

        if($type == 'header') {

            if(C_MODE) $this->check('стиля', $this->header, 'script');
            $this->size += filesize($this->header);

            echo "<link rel='stylesheet preload' href='/" . $this->header . "' as='style'/>";

        } elseif($type == 'styles') {

            foreach($this->styles as $style) {

                if(C_MODE) $this->check('стиля', $style, 'script');
                $this->size += filesize($style);

                echo "<link rel='stylesheet' href='/" . $style . "'/>";
            }
        }
    }

    // Загрузка скриптов JS

    public function loadJS() {

        if(isset($this->scripts[0])) {

            foreach($this->scripts as $script) {

                if(C_MODE) $this->check('скрипта', $script, 'insert');

                echo "link = document.createElement('SCRIPT');
                link.async = true
                link.defer = true
                link.src = '/$script'
                document.querySelector('.wrapper').append(link);" . PHP_EOL;
            }
        }
    }

    // Проверка файлов

    public function check($type, $file, $log = []) {

        try {
            if(!file_exists($file)) throw new \Exception("файл $type: " . $file);
        } catch(\Exception $e) {
            if($log == []) logError($e, 0);
            else logError($e, 'Component', $log);
        }
    }
}