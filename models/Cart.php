<?php


namespace app\models;


use yii\base\Model;

/* Вид массива товаров в корзине
Array(
    ['cart'] => [
        [2] => [
            'title' => 'TITLE',
            'price' => 10,
            'qty' => 2
            ],
        ],
        'cart.qty' => 2,
        'cart.sum' => 20,
)*/


class Cart extends Model
{
    public function addToCart($product, $qty = 1)//кол-во добавляемого товара в корзину
    {
        $qty = ($qty == '-1') ? -1 : 1;//проверяем на истину и присваиваем это значение : или это если не истина
        if(isset($_SESSION['cart'][$product->id]))//если добавляемый продукт уже есть в корзине
            $_SESSION['cart'][$product->id]['qty']+=$qty;//добавь к этому продукту кол-во добавляемых продуктов
        else{//добавляем в массив cart массив продукта
            $_SESSION['cart'][$product->id] = [
                'title' => $product->title,
                'price' => $product->price,
                'qty' => $qty,
                'img' => $product->img,
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        //если существует, то прибавляем кол-во :(или) присваиваем значения кол-ва добавляемого товара
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->price : $qty * $product->price;
        if ($_SESSION['cart'][$product->id]['qty'] == 0)//если кол-во уменьшаемого продукта =0 то удаляем его из массива товаров
            unset($_SESSION['cart'][$product->id]);
    }
    public function recalc($id)
    {
        if(!isset($_SESSION['cart'][$id]))//на случай ручной попытки удаления несуществующего товара в корзине (через Url код строки)
            return false;

        $qtyMinus = $_SESSION['cart'][$id]['qty'];//кол-во товаров к удалению
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];//сумма товаров к удалению

        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$id]);//удаляем товар из сессии
    }
}