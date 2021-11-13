<?php


namespace app\controllers;


use app\models\Product;

class HomeController extends AppController//контроллер главной страницы
{
    public function actionIndex()
    {
        $HotOffers = Product::find()->where(['is_offer' => 1])->limit(4)->all();//запрос в БД с фильтром
        return $this->render('index', compact('HotOffers'));//подключаем вид и передаем данные
    }
}