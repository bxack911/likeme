<?php

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\Image;
use common\models\Language;

class LanguageLinks extends Widget
{
    public function run()
    {
        $languages = Language::findAllActive();

        if(count($languages) <= 1) {
            return false;
        }
        $links = '';

        foreach ($languages as $language) {
            $lang = (Yii::$app->language == $language->code ? 'active' : '');
            
            $icon = '';
            
            if(!empty($language->icon)){
                $icon = Html::img(Image::getThumbPath($language->icon, 14, 11), ['alt' => $language->title]);
            }
            
            $links .= '<li>' . Html::a( $icon . strtoupper($language->title),Url::current(['language' => $language->code])) . '</li>';
        }

        return $links;
    }
}