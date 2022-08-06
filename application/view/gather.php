<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="HandheldFriendly" content="True">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link sizes="16x16" rel="icon" href="<?= $this->icons['general']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.6, user-scalable=yes">
    <title><?= $this->settings['title']; ?></title>
    <meta name="description" content="<?= $this->settings['description']; ?>">
    <? $this->loadCSS('header'); // Стиль первого экрана ?>
</head>
<body>

    <? $this->loadCSS('styles'); // Некритичные стили ?> 

    <div class="wrapper">

        <?  // Загрузка модулей

            foreach($this->partials as $module) {

                if(C_MODE) $this->check('модуля', $module, 'script');
                $this->size += filesize($module);

                include_once $module;
            }

            $this->time += ceil($this->size / 1000);      // Подсчёт отложенного времени для загрузки JS
        ?>

    </div>
    <script id="addJS">

        setTimeout(addJS, <?= $this->time; ?>);           // Отложенная загрузка скриптов JS
        let link;

        function addJS() {

             Promise.resolve()
                    .then(() => { <? $this->loadJS(); ?> })
                    .then(() => { document.getElementById('addJS').remove() });
        }

    </script>
</body>
</html>