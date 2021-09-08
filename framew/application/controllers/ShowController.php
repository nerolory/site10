<?php

namespace application\controllers;

use application\core\Controller;

class ShowController extends Controller
{
    public function newsAction()
    {
        // Рендерим страницу (заглушка)
        $this->view->render('страница новостей');
    }
}
