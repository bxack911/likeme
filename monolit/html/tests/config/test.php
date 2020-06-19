<?php

Yii::setAlias('common', dirname(dirname(dirname(__DIR__))) . '/common');

return [
    'id' => 'app-unit',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@common' => dirname(dirname(__DIR__)) . '\common',
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=local',
            'username' => 'local',
            'password' => 'root',
            'charset' => 'utf8',
        ],
	],
	'language' => 'ru'
];
