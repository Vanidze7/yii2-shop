<?php


namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
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
            [['name', 'email', 'phone', 'address'], 'required'],//валидация
            ['note', 'string'],
            ['email', 'email'],
            [['created_at', 'updated_at'], 'safe'],
            ['qty', 'integer'],
            ['total', 'number'],
            ['status', 'boolean'],//0 или 1
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'note' => 'Примечание',
        ];
    }
}