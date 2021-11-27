<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Product;
use http\Params;

class CartController extends AppController
{
    public function actionAdd($id)
    {
        $product = Product::findOne($id);
        if (empty($product))
            return false;

        $session = \Yii::$app->session;//создаем сессию
        $session->open();//открываем сессию

        $cart = new Cart();//создаем объект модели
        $cart->addToCart($product);//вызовем метод добавления продукта в корзину

        if (\Yii::$app->request->isAjax)
            return $this->renderPartial('cart-modal', compact('session'));
        return $this->redirect(\Yii::$app->request->referrer);//если данные пришли не Ajax
    }

    public function actionShow()
    {
        $session = \Yii::$app->session;
        $session->open();
        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionDelItem()
    {
        $id = \Yii::$app->request->get('id');//получаем идентификатор товара (можно передавать парраметром в функции)
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        if (\Yii::$app->request->isAjax)
            return $this->renderPartial('cart-modal', compact('session'));
        return $this->redirect(\Yii::$app->request->referrer);//если данные пришли не Ajax
    }

    public function actionChangeCart()
    {
        $id = \Yii::$app->request->get('id');
        $qty = \Yii::$app->request->get('qty');

        $product = Product::findOne($id);
        if (empty($product))
            return false;

        $session = \Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->addToCart($product, $qty);
        return $this->renderPartial('cart-modal', compact('session'));//почему здесь cart-modal
    }

    public function actionClear()
    {
        $session = \Yii::$app->session;
        $session->open();
        $session->remove('cart');//удаляем все товары
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionCheckout()
    {
        $session = \Yii::$app->session;
        $this->setMeta("Оформление заказа: " . \Yii::$app->name);

        $order = new Order();
        $order_product = new OrderProduct();
        if ($order->load(\Yii::$app->request->post()))//если данные с формы получены postom
        {
            $order->qty = $session['cart.qty'];//дозаполняем массив товаров значениями общей суммы и кол-ва
            $order->total = $session['cart.sum'];
            $transaction = \Yii::$app->getDb()->beginTransaction();
            if (!$order->save() || !$order_product->saveOrderProducts($session['cart'], $order->id))//если сохранение в базу или выполнение метода false
            {
                \Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
                $transaction->rollBack();//откатим транзакцию
            } else {
                $transaction->commit();//применяем транзакцию
                \Yii::$app->session->setFlash('success', 'Ваш заказ принят');

                try {//нехрена непонял, зачем try?
                    \Yii::$app->mailer->compose('order', ['session' => $session])//отправляем вид с товарами заказа
                    ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])//от кого письмо + название сайта (можно только почта, без массива)
                    ->setTo([$order->email, \Yii::$app->params['adminEmail']])//кому отправляем письма
                    ->setSubject('Заказ на сайте')//тема письма
                    ->send();//отправляем письмо
                }catch(\Swift_TransportException $e){}

                $session->remove('cart');//очищаем корзину
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            }
        }
        return $this->render('checkout', compact('session', 'order'));
    }
}