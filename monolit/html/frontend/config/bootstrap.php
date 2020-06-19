<?php

if(!function_exists('t')) {
    function t($message, $params = [], $language = null)
    {
        return Yii::t('app', $message, $params = [], $language = null);
    }
}