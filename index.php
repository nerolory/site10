<?php

// Функция проверки значений
require 'application/lib/Dev.php';

use application\core\Router;

// Автозагрузчик классов
spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class . '.php');
    if (file_exists($path)) {
        require $path;
    }
});

// Сессия
session_start();

$router = new Router;

// вызываем Роутер страниц
$router->run();
