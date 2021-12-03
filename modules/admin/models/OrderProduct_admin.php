<?php

namespace app\modules\admin\models;

use Yii;

class OrderProduct_admin extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'order_product';
    }

    public function getOrder_admin()//привязываем таблицу (модель) заказов
    {
        return $this->hasOne(Order_admin::class, ['id' => 'order_id']);
    }

    public function rules()
    {
        return [
            [['order_id', 'product_id', 'title', 'qty', 'total'], 'required'],
            [['order_id', 'product_id', 'qty'], 'integer'],
            [['price', 'total'], 'number'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'title' => 'Title',
            'price' => 'Price',
            'qty' => 'Qty',
            'total' => 'Total',
        ];
    }
}
