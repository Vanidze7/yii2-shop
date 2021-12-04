<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Список карапузов';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Добавить карапуза', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="box-body">
                <div class="category-admin-index">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],
                            'id',
                            'title',
                            //'parent_id',
                            [
                                'attribute' => 'parent_id',
                                'value' => function($data){//откуда эта переменная?
                                    //при значении parent_id не 0 (true) выведи это или если 0 (false) выведи это
                                    return $data->parent_id ? '<span class="text-dark">' . $data->category_admin->title . '</span>' : '<span class="text-gray">Сирота</span>';
                                    //return $data->category_admin->title ?? 'Сирота';//без стилей
                                },
                                'format' => 'raw'//формат вывода данных
                            ],
                            //'description',
                            //'keywords',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>





</div>
