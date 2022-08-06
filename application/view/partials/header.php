<?php

    $icons = $this->icons['header'];
    $meta = $this->settings;
?>

<header>
<h1><?= $meta['h1']; ?></h1>
    <p><?= $meta['annotation']; ?></p>
    <ul>
        <li><a href="/">
            <img width="24" height="24" alt="" src="<?= $icons['main'];?>"> Главная
        </a></li>
        <?php if(!isset($_COOKIE['user'])): ?>
            <li><a href="/authorization">
                <img width="24" height="24" alt="" src="<?=$icons['cabinet'];?>">
                <span>Авторизация</span>
            </a></li>
            <li><a href="/registration">
                <img width="24" height="24" alt="" src="<?=$icons['cabinet'];?>">
                <span>Регистрация</span>
            </a></li>
        <? endif; ?>
    </ul>
</header>