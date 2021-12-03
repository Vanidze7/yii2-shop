<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Список сосисок';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Создать заказик', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="box-body">
                <div class="order-admin-index">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [//выводимые столбцы БД
                            //['class' => 'yii\grid\SerialColumn'],//для вывода нумерации заказов
                            'id',
                            'created_at',
                            /*['attribute' => 'created_at', 'format' => ['datetime', 'php:d M Y H:i:s']],
                            ['attribute' => 'created_at', 'format' => 'datetime'],//правила вывода даты для конкретного значения (атрибута)*/
                            'updated_at',
                            'qty',
                            'total',
                            [
                                'attribute' => 'status',
                                'value' => function($data){
                                    //при значении статуса 1 (true) выведи это или если 0 (false) выведи это
                                    return $data->status ? '<span class="text-green">Оформлен</span>' : '<span class="text-red">Ждет оформления</span>';
                                },
                                'format' => 'raw'//формат вывода данных
                            ],
                            'name',
                            //'email:email',
                            //'phone',
                            //'address',
                            'note:ntext',
                            ['class' => 'yii\grid\ActionColumn', 'header' => 'Действия BEACH'],//для вывода значков редактирования
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>


