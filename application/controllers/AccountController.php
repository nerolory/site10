<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller
{
    // Контроллер страницы входа
    public function loginAction()
    {
        // Проверка на ошибки (заглушка)
        if (!empty($_POST)) {
            $this->view->message('error', 'Text error');
        }
        // Рендерим страницу (заглушка)
        $this->view->render('страница входа');
    }

    // Контроллер страницы регистрации
    public function registerAction()
    {
        // Рендерим страницу (заглушка)
        $this->view->render('страница регистрации');
    }
}
