<?php
// Возвращаем массив сущностей для переходов по страницам
return [
    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],
    'contact' => [
        'controller' => 'main',
        'action' => 'contact'
    ],
    'account/login' => [
        'controller' => 'account',
        'action' => 'login'
    ],
    'account/register' => [
        'controller' => 'account',
        'action' => 'register'
    ],
    'show/news' => [
        'controller' => 'show',
        'action' => 'news'
    ]

];
