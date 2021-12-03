<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = "Заказ № {$model->id}";
$this->params['breadcrumbs'][] = ['label' => 'Список сосисок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Обработай меня', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удали меня', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="box-body">
                <div class="order-admin-view">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'created_at:datetime',//с указанием формата
                            'updated_at',
                            'qty',
                            'total',
                            [
                                'attribute' => 'status',
                                'value' => $model->status ? '<span class="text-green">Оформлен</span>' : '<span class="text-red">Ждет оформления</span>',
                                'format' => 'raw'//формат вывода данных
                            ],
                            'name',
                            'email',
                            'phone',
                            'address',
                            'note:ntext',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $items = $model->orderProduct_admin //?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Товары в заказе</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Наименование</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Сумма</th>
                    </tr>
                    <?php foreach($items as $item):?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td><?= $item->title ?></td>
                            <td><?= $item->qty ?></td>
                            <td><?= $item->price ?></td>
                            <td><?= $item->total ?></td>
                        </tr>
                    <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
