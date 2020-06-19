<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','telegram'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
         //...
         'telegram' => [
             'class' => 'onmotion\telegram\Module',
             'API_KEY' => '973417370:AAEC4zt3XRfyplef_5gevztmtDOjhjmgNM4',
             'BOT_NAME' => 'VradoBot',
         ]
     ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        'urlManager' => array(
            'baseUrl' => '/',
            'scriptUrl' => '/',
            'showScriptName' => false,
            'rules' => require('_url_manager.php'),
        ),
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
