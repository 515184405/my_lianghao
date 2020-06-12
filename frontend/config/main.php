<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\Member',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                "news/<action:\w+>/<news_id:\d+>"=>"news/<action>",
                "case/<action:\w+>/<case_id:\d+>"=>"case/<action>",
                "unit/<action:\w+>/<widget_id:\d+>"=>"unit/<action>",
                "unit/<action:\w+>/yanshi<widget_id:\d+>"=>"unit/<action>",
                "other/<action:\w+>/<u_id:\d+>/<type:\d+>"=>"other/<action>",
                //"widget-file/<action:\w+>/<create_time:\d+>/<id:\d+>/<title:\w+>"=>"widget-file/<action>",
            ],
        ],
    ],
    'params' => $params,
];
