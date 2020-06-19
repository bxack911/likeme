<?php

namespace frontend\widgets;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\base\Widget;
use lakerLS\nestedSet\Menu;
use common\models\Menu as MenuModel;
use common\models\Language;

/**
 * LanguagesLinks
 */
class MenuWidget extends Widget
{
  public $root = 11;

  public function run()
  {
    $menu = MenuModel::find()->where(['id' => $this->root])->one();
    $childs = $menu->children()->andWhere(['active' => 1])->all();

    return Menu::widget([
      'allCategories' => $childs,
      'beginLvl' => 1,
      'options' => [
        'main' => [
          'ul' => ['class' => 'menu menu--main menu--horizontal'],
          'lonely' => [
            'li' => ['class' => 'menu-node menu-node--main_lvl_1'],
            'a' => ['class' => 'menu-link'],
          ],
          'hasNesting' => [
            'li' => ['class' => 'menu-node menu-node--main_lvl_1'],
            'a' => ['class' => 'menu-link'],
            'icon' => 'fa fa-angle-down'
          ],
          'active' => [
            'a' => ['class' => 'maybe-necessary-a-instead-of-li',
            ]
          ],
        ],
        'nested' => [
          'ul' => ['class' => 'menu menu--horizontal menu--dropdown menu--main_lvl_2'],
          'lonely' => [
            'li' => ['class' => 'menu-node menu-node--main_lvl_2'],
            'a' => ['class' => 'menu-link'],
          ],
          'hasNesting' => [
            'li' => ['class' => 'menu-node menu-node--main_lvl_2'],
            'a' => ['class' => 'menu-link'],
            'icon' => 'fa fa-angle-right'
          ],
          'active' => [
            'a' => ['class' => 'maybe-necessary-a-instead-of-li',
            ]
          ],
        ],
      ],
    ]);
  }
}
