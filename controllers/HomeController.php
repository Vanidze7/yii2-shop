<?php


namespace app\controllers;


class HomeController extends AppController//контроллер главной страницы
{
    public function actionIndex()
    {
        return $this->render('index');//подключаем вид
    }
}