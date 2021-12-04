<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="category-admin-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-category-admin-parent_id">
        <label class="control-label" for="category-admin-parent_id">Родительский карапуз</label>
        <select id="category-admin-parent_id" class="form-control" name="Category_admin[parent_id]">
            <option value="0">Сирота</option>
            <?= \app\components\LeftbarWidget::widget([
                'tpl' => 'select',//подключаемый шаблон
                'model' => $model,//передаем нашу категорию
                'cache_time' => 0,
            ]) ?>
        </select>
        <div><div class="help-block"></div></div>
    </div>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
