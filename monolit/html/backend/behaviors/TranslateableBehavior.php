<?php

namespace backend\behaviors;

use Yii;

class TranslateableBehavior extends \creocoder\translateable\TranslateableBehavior
{
    public function getTranslation($language = null)
    {
        if ($language === null) {
            $language = Yii::$app->config->get('pagesLanguage');
        }

        return parent::getTranslation($language);
    }
}