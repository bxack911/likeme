<?php

namespace frontend\widgets;

use common\models\Menu as MenuModel;
use yii\base\InvalidConfigException;

class Menu extends \yii\widgets\Menu
{
    public $key;

    public function init()
    {
        if($this->key === null) {
            throw new InvalidConfigException("'key' property is required");
        }

        $this->items = MenuModel::findItems($this->key);

        parent::init();
    }
}