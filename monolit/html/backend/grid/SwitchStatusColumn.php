<?php

namespace backend\grid;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

class SwitchStatusColumn extends ActionColumn
{
    public $template = '{switch-status}';

    /**
     * @var bool|\Closure
     */
    public $checked;

    public $format = 'raw';

    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['switch-status'])) {
            $this->buttons['switch-status'] = function ($url, $model, $key) {

                if (is_callable($this->checked)) {
                    $checked = call_user_func($this->checked, $model, $key, $this);
                } else {
                    $checked = $this->checked;
                }

                if($checked == 1){
                    return Html::a(
                        '<i class="glyphicon glyphicon-ok" style="color:#5cb85c"></i>'
                        , $url, ['data-method' => 'post']);
                } elseif($checked == 2) {
                    return Html::a(
                        '<i class="glyphicon glyphicon-ok-sign" style="color:#0e8eab"></i>'
                        , $url, ['data-method' => 'post']);
                } else {
                    return Html::a(
                        '<i class="glyphicon glyphicon-remove" style="color:#c9302c"></i>'
                        , $url, ['data-method' => 'post']);
                }

                /*return Html::a($checked ?
                    '<i class="glyphicon glyphicon-ok" style="color:#5cb85c"></i>' :
                    '<i class="glyphicon glyphicon-remove" style="color:#c9302c"></i>'
                    '<i class="glyphicon glyphicon glyphicon-asterisk" style="color:#fff"></i>'
                    , $url, ['data-method' => 'post']);*/
            };
        }
    }
}