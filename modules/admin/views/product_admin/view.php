<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = "Продукт {$model->title}";
$this->params['breadcrumbs'][] = ['label' => 'Список продуктов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Запеленать продукт', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удали меня', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="box-body">
                <div class="product-admin-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            //'category_id',
                            [
                                'attribute' => 'category_id',
                                'value' => '<a href="'.\yii\helpers\Url::to(['category_admin/view', 'id' => $model->category_id]).'">' . $model->category_admin->title . '</a>',
                                'format' => 'raw'//формат вывода данных
                            ],
                            'title',
                            'content:raw',
                            'price',
                            'old_price',
                            //'description',
                            //'keywords',
                            'img',
                            [
                                'attribute' => 'img',
                                'value' => "/{$model->img}",//путь к картинке
                                'format' => ['image', ['width' => 100]]//формат вывода данных с парраметрами
                            ],
                            //'is_offer',
                            [
                                'attribute' => 'is_offer',
                                'value' => function($data){
                                    //при значении статуса 1 (true) выведи это или если 0 (false) выведи это
                                    return $data->is_offer ? '<span class="text-red">Горячий</span>' : '<span class="text-gray">Тухлый</span>';
                                },
                                'format' => 'raw'//формат вывода данных
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
