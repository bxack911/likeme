<?php

namespace backend\grid;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{
    /**
     * @inheritdoc
     */
    protected function initDefaultButtons()
    {
        /**
         * Bootstrap button group wrapper for action buttons
         */
        $this->template = '<div class="btn-group btn-group-xs">' . $this->template . '</div>';

        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Update'),
                    'aria-label' => Yii::t('yii', 'Update'),
                    'class' => 'btn btn-default',
                    'data-pjax' => '0',
                    'data-toggle' => 'tooltip',
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Delete'),
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'class' => 'btn btn-danger',
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                    'data-toggle' => 'tooltip',
                ], $this->buttonOptions);
                return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, $options);
            };
        }
    }
}