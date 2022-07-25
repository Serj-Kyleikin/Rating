<?php

// Ограничение видимости для посетителей сайта

function a() {
    return (isset($_COOKIE['admin'])) ? true : false;
}

function t() {
    if(!isset($_COOKIE['admin'])) echo "<script>window.location.href = '/307.php';</script>";
}

// Отладка приложения

function p($data) {
    echo '<pre>';
	var_dump($data);
	echo '</pre>';
}

function e($data) {
    echo '<pre>';
	var_dump($data);
	echo '</pre>';
    exit;
}