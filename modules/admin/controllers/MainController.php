<?php


namespace app\modules\admin\controllers;


use app\modules\admin\models\Category_admin;
use app\modules\admin\models\Order_admin;
use app\modules\admin\models\Product_admin;

class MainController extends AppAdminController
{
    public function actionIndex()
    {
        $orders = Order_admin::find()->count();//для вывода кол-ва заказов
        $products = Product_admin::find()->count();
        $categories = Category_admin::find()->count();

        return $this->render('index', compact('orders', 'products', 'categories'));
    }
}