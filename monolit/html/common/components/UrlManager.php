<?php
namespace common\components;

use Yii;

class UrlManager extends \yii\web\UrlManager {

    public function createUrl($params) {

        $url = parent::createUrl($params);

        if (empty($params['lang'])) {
            $curentLang = Yii::$app->language;

            if ($url == '/') {
                return '/' . $curentLang;
            } else {
                return '/' . $curentLang . $url;
            }
        };

        return $url;
    }
}