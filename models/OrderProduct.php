<?php


namespace app\models;


use yii\db\ActiveRecord;

class OrderProduct extends ActiveRecord
{
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'title', 'price', 'qty', 'total'], 'required'],
            [['order_id', 'product_id', 'qty'], 'integer'],
            [['price', 'total'], 'number'],
            [['title'], 'string', 'max' => 255],
        ];
    }
    public function saveOrderProducts($products, $order_id)
    {
        foreach($products as $id => $product)//присваиваем значения объекту БД и сохраняем их
        {
            $this->id = null;//обнуляем id (после save в контроллере), чтобы избежать дублирование одного товара
            $this->isNewRecord = true;//обновляем объект модели?
            $this->order_id = $order_id;
            $this->product_id = $id;
            $this->title = $product['title'];
            $this->price = $product['price'];
            $this->qty = $product['qty'];
            $this->total = $product['qty'] * $product['price'];
            if(!$this->save())
                return false;
        }
        return true;
    }
}