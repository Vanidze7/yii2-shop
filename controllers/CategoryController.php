<?php


namespace app\controllers;


use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class CategoryController extends AppController
{
    public function actionView($id)
    {
        $category = Category::findOne($id);
        if(empty($category))
            throw new NotFoundHttpException('Такой категории нет, сучка!');//сообщение с ошибкой

        $this->setMeta("{$category->title} :" . \Yii::$app->name, $category->keywords, $category->description);
        //прописываем имя вкладки и приклеиваем имя из web с другими

        //$products = Product::find()->where(['category_id' => $id])->all();

        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 2, 'pageSizeParam' => false]);//для постраничной навигации
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();//нужно пояснение

        return $this->render('view', compact('products', 'category', 'pages'));
    }
}
