<?php

Yii::setAlias('@common', dirname(dirname(__DIR__)) . '\common');
define('FRONTEND_ALIAS', dirname(dirname(__DIR__)) . '\frontend');
Yii::setAlias('@frontend', FRONTEND_ALIAS);
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '\backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '\console');
Yii::setAlias('@storage', dirname(dirname(__DIR__)) . '\storage');
Yii::setAlias('@vendor', dirname(dirname(__DIR__)) . '\vendor');
Yii::setAlias('@root', dirname(dirname(__DIR__)));