<?php


namespace app\modules\admin\controllers;

use app\models\LoginForm;
use Yii;

class AuthController extends AppAdminController
{
    public $layout = 'auth';//шаблон

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)//если пользователь уже авторизован
            return $this->redirect('/admin');//на главную страницу

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
            return $this->redirect('/admin');

        $model->password = '';
        return $this->render('login', ['model' => $model]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/admin');
    }
}