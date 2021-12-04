<?php

namespace app\modules\admin\models;

use Yii;

class Category_admin extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function getCategory_admin()
    {
        return $this->hasOne(Category_admin::class, ['id' => 'parent_id']);//связываем столбцы БД
    }

    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['title'], 'required'],
            [['title', 'description', 'keywords'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительский карапуз',
            'title' => 'Наименование',
            'description' => 'Описание',
            'keywords' => 'Ключевое слово',
        ];
    }
}
