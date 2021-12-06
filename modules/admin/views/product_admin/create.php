<?php

use yii\helpers\Html;

$this->title = 'Добавить продукт';
$this->params['breadcrumbs'][] = ['label' => 'Список продуктов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="product-admin-create">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

