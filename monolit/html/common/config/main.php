<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'container' => [
      'singletons' => [
        'Order' => ['class' => '\common\modules\shop\common\models\Order'],
        'Cart' => ['class' => '\common\modules\shop\common\models\Cart'],
      ]
    ],
    'modules' => [
      'shop' => [
        'class' => 'common\modules\shop\ShopModule'
      ],
      'treemanager' =>  [
        'class' => '\kartik\tree\Module',
        // other module settings, refer detailed documentation
      ],
      'mailler' => [
        'class' => 'yii\swiftmailer\Mailer',
        'useFileTransport' => true,
      ],
        /*'telegram' => [
            'class' => 'onmotion\telegram\Module',
            'API_KEY' => '973417370:AAEC4zt3XRfyplef_5gevztmtDOjhjmgNM4',
            'BOT_NAME' => 'VradoBot',
            'hook_url' => '/telegram/default/hook', // must be https!
            'PASSPHRASE' => 'passphrase for login'
        ]*/
    ],
    'components' => [
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '192.168.39.67:31635',
            'port' => 6379,
            'database' => 0,
        ],
        'logstash' => [
            'class' => \mitrm\logstash\LogstashSend::class,
            'config' => [
                'class' => \mitrm\logstash\transport\HttpTransport::class,
                'port' => 30005,
                'host' => 'http://172.17.0.3'
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \mitrm\logstash\LogstashTarget::class,
                    'levels' => ['error'],
                    'logVars' => ['_GET', '_POST', '_SESSION', '_SERVER'],
                    'clientOptions' => [
                        'release' => $params['release_app'] ?? null,
                    ],
                    'isLogUser' => true, // Добавить в лог ID пользователя
                    'isLogContext' => false,
                    'extraCallback' => function ($message, $extra) {
                        $extra['app_id'] = Yii::$app->id;
                        return $extra;
                    },
                    'except' => ['order'],
                ],
            ],
        ],
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'autodetectCluster' => false,
            'nodes' => [
                ['http_address' => '172.17.0.3:30003'],
            ],
        ],
        'image' => array(
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ),
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@frontend/runtime/cache',
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => '{{%rbac_auth_item}}',
            'itemChildTable' => '{{%rbac_auth_item_child}}',
            'assignmentTable' => '{{%rbac_auth_assignment}}',
            'ruleTable' => '{{%rbac_auth_rule}}'
        ],
        'i18n' => [
            'translations' => [
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en-US',
                ],
                'common*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en-US',
                ]
            ],
        ],
        'config' => [
            'class' => 'common\components\Config',
        ],
    ],
    'language' => 'ru',
];
