<?php

namespace frontend\components;

use yii\web\Response as BaseResponse;

class Response extends BaseResponse
{
    /**
     * @inheritdoc
     * @param integer $statusCode the HTTP status code. Default value changed to 301 for seo reasons.
     */
    public function redirect($url, $statusCode = 301, $checkAjax = true)
    {
        return parent::redirect($url, $statusCode, $checkAjax);
    }
}