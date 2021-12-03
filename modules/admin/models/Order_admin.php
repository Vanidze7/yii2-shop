<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Order_admin extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }

    public function getOrderProduct_admin()//привязываем таблицу (модель) заказов
    {
        //привязываемая модель таблицы, [имя столбца привязываемой таблицы => имя столбца данной модели]
        return $this->hasMany(OrderProduct_admin::class, ['order_id' => 'id']);
    }

    public function behaviors()//поведение Yii заполняющий ячейки БД
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],//перед добавлением новой записи указанные поля заполняться методом выше(TimestampBehavior)
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],//перед обновлением записи
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),//текущее значение
            ],
        ];
    }

    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'qty', 'name', 'email', 'phone', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty', 'status'], 'integer'],
            [['total'], 'number'],
            [['note'], 'string'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()//переназначение наименований
    {
        return [
            'id' => 'ID',
            'created_at' => 'Создано',
            'updated_at' => 'Обработано',
            'qty' => 'Кол-во',
            'total' => 'Сумма',
            'status' => 'Статус',
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адрес собаки',
            'note' => 'Примечание',
        ];
    }
}
