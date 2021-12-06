<?php

use kartik\file\FileInput;
use mihaildev\elfinder\ElFinder;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

mihaildev\elfinder\Assets::noConflict($this);
?>

<div class="product-admin-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="form-group field-product-admin-category_id">
        <label class="control-label" for="product-admin-category_id">Родительский карапуз</label>
        <select id="product-admin-category_id" class="form-control" name="Product_admin[category_id]">
            <?= \app\components\LeftbarWidget::widget([
                'tpl' => 'select_product',//подключаемый шаблон
                'model' => $model,//передаем нашу категорию
                'cache_time' => 0,
            ]) ?>
        </select>
        <div><div class="help-block"></div></div>
    </div>
    <?php echo $form->field($model, 'content')->widget(CKEditor::class,[//для редактирования содержимого
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */])
        ]);
    ?>
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'file')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showCaption' => false,//настройки
            'showUpload' => false,
        ],
    ]); ?>
    <?= $form->field($model, 'is_offer')->dropDownList(['Тухлый', 'Горячий']) ?>
    <div class="form-group">
        <?= Html::submitButton('Запеленать', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
