<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'glavnay',//устанавливаем основной шаблон
    'defaultRoute' => 'home/index',//устанавливаем путь главной страницы
    'language' => 'ru',
    'name' => 'Главная шлюха района',//имя в шапке
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [//подключаем модуль админа
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'admin',//подключаем админский шаблон
            'defaultRoute' => 'main/index',//устанавливаем путь админской страницы
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '8TNYZtMx3fJw6nGvcP88LVpShiCTf7W3',
            'baseUrl' => '',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // не опубликовывать комплект
                    'js' => [
                        'js/jquery-1.11.1.min.js',//подключаемый скрипт
                    ]
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',//используется для кэширования данных
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/admin/auth/login',//че-то там
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,//включение отправки почты (на false)
            'transport' => [//настройка отправки почты
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.ukr.net',//через какой хост(gmail, mail, yandex)
                'username' => 'noreply@example.com',//с какой почты (из params)
                'password' => 'password',//от чего не понял
                'port' => '2525', // 465
                'encryption' => 'ssl', // tls
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'category/<id:\d+>/page/<page:\d+>' => 'category/view',//нужно пояснение как это работает
                'category/<id:\d+>' => 'category/view',//переназначаем вид ссылки (на => с)
                'product/<id:\d+>' => 'product/view',
                'search' => 'category/search',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
