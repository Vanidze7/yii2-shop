<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Order_admin;
use app\modules\admin\models\OrderProduct_admin;
use Yii;
use yii\data\ActiveDataProvider;
use app\modules\admin\controllers\AppAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class Order_adminController extends AppAdminController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order_admin::find(),
            'pagination' => [//постраничная навигация
                'pageSize' => 2
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,//обратная сортировка
                ]
            ],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Order_admin();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Твоя обработка возымела эффект');//прописываем флеш сообщение
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        //$this->findModel($id)->unlinkAll('orderProduct', true);//название связи
        $this->findModel($id)->delete();
        OrderProduct_admin::deleteAll(['order_id' => $id]);//удаление товаров заказа
        Yii::$app->session->setFlash('success', 'Сосиска уничтожена');

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Order_admin::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
