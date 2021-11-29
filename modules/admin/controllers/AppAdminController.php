<?php

namespace app\modules\admin\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class AppAdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],//разрешаемый метод
                        'roles' => ['?'],//для гостей
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],//для зарегистрированных
                    ],
                ],
            ],
        ];
    }
}