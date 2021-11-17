<?php


namespace app\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public function getCategory()//привязываем таблицу категории
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']); //привязываемая модель таблицы, [имя столбца привязываемой таблицы с столбцом данной модели]
    }
}