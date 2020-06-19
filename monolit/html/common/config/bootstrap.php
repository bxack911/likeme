<?php

use yii\di\Container;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

$container = Yii::$container;

Yii::setAlias('@common', dirname(__DIR__));
define('FRONTEND_ALIAS', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@frontend', FRONTEND_ALIAS);
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@storage', dirname(dirname(__DIR__)) . '/storage');
Yii::setAlias('@vendor', dirname(dirname(__DIR__)) . '/vendor');
Yii::setAlias('@root', dirname(dirname(__DIR__)));
//var_dump(Yii::getAlias('@vendor'));exit();


$container = Yii::$container;
$container->setSingletons([
    Client::class => function () {
        $hosts = ArrayHelper::getColumn(Yii::$app->elasticsearch->nodes, 'http_address');
        return ClientBuilder::create()->setHosts($hosts)->build();
    },
]);
