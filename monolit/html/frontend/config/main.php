<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'i18n', 'common\components\ModulesBootstrap'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*']
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@frontend/runtime/cache'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'db' => [
                'enableSchemaCache' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => require(__DIR__ . '/_urlManager.php'),
        'assetManager' => [
            'linkAssets' => true,
        ],
        'request' => [
            'enableCsrfCookie' => false,
            'baseUrl' => '',
        ],
        'response' => [
            'class' => 'frontend\components\Response'
        ],
        'view' => [
            //'theme' => require(__DIR__ . '/_theme.php'),
        ],
        'i18n' => [
            'class' => 'common\components\I18N',
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'cookieParams' => ['httponly' => true, 'lifetime' => 2*24*60*60],
            'timeout' => 2*24*60*60, //session expire
            'useCookies' => true,
        ],
    ],
    'language' => 'ru',
    'sourceLanguage' => 'ru',
    'params' => $params,
];
