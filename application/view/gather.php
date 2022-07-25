<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="HandheldFriendly" content="True">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.6, user-scalable=yes">
    <title><? echo $this->settings['title']; ?></title>
    <meta name="description" content="<? echo $this->settings['description']; ?>">
    <?php $this->loadCSS('header'); // Стиль первого экрана ?>
</head>
<body>

    <?php $this->loadCSS('styles'); // Некритичные стили ?> 

    <div class="wrapper">

        <?php

            // Загрузка модулей

            foreach($this->partials as $module) {
                if(C_MODE) $this->check('модуля', $module, 'script');
                include_once $module;
            }
        ?>

    </div>
    <script>

        // Отложенная загрузка скриптов JS

        if(!document.getElementById('js_0')) {

            setTimeout(addJS, 100);
            let link;

            function addJS() {
                <?php $this->loadJS(); ?>
            }
        }

    </script>
</body>
</html>