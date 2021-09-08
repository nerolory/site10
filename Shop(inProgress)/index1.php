<?php
//загружаем библиотеки twig
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

//подключаем twig
require_once 'vendor/autoload.php';

try {
    //место хранения шаблона
    $loader = new FilesystemLoader('templates');
    $blocks = new FilesystemLoader('blocks');
    //инициализация шаблона
    $twig = new Environment($loader);
    $twigBlock = new Environment($blocks);

    $template = $twig->load('index.twig');

    $header = $twigBlock->load('header.php');

    $content = $template->render([
        'tittle' => 'My Site',
        'header' => $header
    ]);

    echo $content;
} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}
