<?php

namespace common\components;

use Yii;
use common\models\Language;
use yii\base\BootstrapInterface;

class I18N extends \yii\i18n\I18N implements BootstrapInterface
{
    public $languages = [];

    /**
     * @param \yii\base\Application $app
     *
     * Fills array of i18n languages
     */
    public function bootstrap($app)
    {
        $languages = [];
        foreach (Language::findAllActive() as $language) {
            $languages[] = $language->code;
        }

        $this->languages = $languages;
    }
}