<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function IndexAction()
    {
        // Если массив пустой, то не выводит ошибку
        $vars = [];

        // Получаем массив через фунцию getGoods()
        $result = $this->model->getGoods();

        // Передаем данные массива из БД
        $vars = ['good' => $result];

        // Рендерим страницу, передаем данные
        $this->view->render('главная страница', $vars);
    }

    public function contactAction()
    {
        // Рендерим страницу (заглушка)
        $this->view->render('контакты');
    }
}
