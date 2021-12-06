<?php

use yii\helpers\Html;

$this->title = 'Запеленать продукт: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Список продуктов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Продукт {$model->title}", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Запеленать продукт';
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="product-admin-update">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
