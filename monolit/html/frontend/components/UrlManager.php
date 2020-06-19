<?php

namespace frontend\components;

use Yii;
use codemix\localeurls\UrlManager as BaseUrlManager;

class UrlManager extends BaseUrlManager
{
    /**
     * Inits i18n languages
     */
    public function init()
    {
        $this->languages = Yii::$app->i18n->languages;
        parent::init();
    }

}