<?php

namespace frontend\widgets;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\base\Widget;
use common\models\Language;

/**
 * LanguagesLinks
 */
class LanguagesDropdown extends Widget
{
	public $items = [];
    public $labelAttribute = 'icon';

    public function init()
    {
        $languages = Language::find()->where(['status' => 1])->orderBy('sort_order')->all();

        if(count($languages) <= 1) {
            return false;
        }
        foreach ($languages as $language) {
            $this->items[] = Html::a(str_replace('si', 'sl', $language->code), Url::current(['language' => $language->code]), ['class' => Yii::$app->language == $language->code ? 'active_lang':'']);
        }

        echo implode (' ', $this->items);
    }
}