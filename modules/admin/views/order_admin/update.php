<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order_admin */

$this->title = 'Редактирование заказа № ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Список сосисок', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Заказ № {$model->id}", 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обработай меня';
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="order-admin-update">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

