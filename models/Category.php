<?php


namespace app\models;


use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
//    public function getProducts($id)//привязываем таблицу продукты
//    {
//        //привязываемая модель таблицы, [имя столбца привязываемой таблицы со столбцом данной модели] дополняем запрос
//        return $this->hasMany(Product::class, ['category_id' => 'id'])->where('price < :price', [':price' => $price])->orderBy('price');
//    }
}