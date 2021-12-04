<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = "Карапуз {$model->title}";
$this->params['breadcrumbs'][] = ['label' => 'Список карапузов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Запеленать карапуза', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удали меня', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="box-body">
                <div class="category-admin-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'title',
                            //'parent_id',
                            [
                                'attribute' => 'parent_id',
                                'value' => isset($model->category_admin->title) ?
                                    '<span class="text-dark">
                                        <a href="'.\yii\helpers\Url::to(['category_admin/view', 'id' => $model->parent_id]).'">' . $model->category_admin->title . '</a>
                                    </span>' :
                                    '<span class="text-gray">
                                        Сирота
                                    </span>',
                                'format' => 'raw'//формат вывода данных
                            ],
                            'description',
                            'keywords',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
