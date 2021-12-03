<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="order-admin-form">
    <?php $form = ActiveForm::begin([
        'fieldConfig' => [//парраметры каждого поля
            'template' => "
                <div class='col-md-6'>
                    <p>{label}</p> \n {input} \n
                    <div>{error}</div>
                </div>"]
            ]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList(['Ждет оформления', 'Оформлен']) //выпадающий список ?>
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
