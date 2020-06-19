<?php

namespace common\helpers;

use Yii;
use yii\helpers\Url;
use frontend\widgets\BreadcrumbsWidget as Breadcrumbs;


class BreadcrumbsHelper
{
  public static function get($breadcrumbs)
  {
    $html = Breadcrumbs::widget([
      'homeLink' => ['label' => 'Главная', 'url' => Url::to(['/']), 'class' => 'breadcrumbs-page breadcrumbs-page--home'],
      'links' => $breadcrumbs,
      'itemTemplate'  =>  '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">{link}</span><span class="breadcrumbs-pipe">/</span>' .PHP_EOL,
      'activeItemTemplate' => '<span class="active">{link}</span>' . PHP_EOL,
      'tag' => 'div',
      'options' => [
        'class' => '',
        'itemtype'     => 'http://schema.org/BreadcrumbList',
        'itemscope'    => ''
      ]
    ]);

    return $html;
  }
}
