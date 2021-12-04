<?php

use yii\helpers\Html;

$this->title = 'Редактирование карапуза: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Список карапузов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Карапуз {$model->title}", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Запеленать карапуза';
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="category-admin-update">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
