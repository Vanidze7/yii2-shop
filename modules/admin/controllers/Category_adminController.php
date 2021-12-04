<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Category_admin;
use app\modules\admin\models\CategorySearch_admin;
use app\modules\admin\controllers\AppAdminController;
use app\modules\admin\models\Product_admin;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class Category_adminController extends AppAdminController
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
        $searchModel = new CategorySearch_admin();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
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
        $model = new Category_admin();

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
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $cats = Category_admin::find()->where(['parent_id' => $id])->count();//если есть дочерние категории у удаляемой
        $products = Product_admin::find()->where(['category_id' => $id])->count();//если есть продукты у удаляемой категории
        if($cats || $products){
            Yii::$app->session->setFlash('error', 'Удаление невозможно: к категории прикреплены другие категории или товары');
        }else{
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', 'Категория удалена');
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Category_admin::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
