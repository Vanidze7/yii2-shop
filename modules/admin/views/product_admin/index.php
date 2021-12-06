<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Список продуктов';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Добавить продукт', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="box-body">
                <div class="product-admin-index">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],

                            'id',
                            //'category_id',
                            [
                                'attribute' => 'category_id',
                                'value' => function($data){
                                    //при значении статуса 1 (true) выведи это или если 0 (false) выведи это
                                    return '<span class="text-dark">' . $data->category_admin->title . '</span>';
                                    },
                                'format' => 'raw'//формат вывода данных
                            ],
                            'title',
                            //'content:ntext',
                            'price',
                            //'old_price',
                            //'description',
                            //'keywords',
                            //'img',
                            //'is_offer',
                            [
                                'attribute' => 'is_offer',
                                'value' => function($data){
                                    //при значении статуса 1 (true) выведи это или если 0 (false) выведи это
                                    return $data->is_offer ? '<span class="text-red">Горячий</span>' : '<span class="text-gray">Тухлый</span>';
                                },
                                'format' => 'raw'//формат вывода данных
                            ],
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
