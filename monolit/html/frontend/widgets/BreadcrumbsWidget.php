<?php
/*
<?= Breadcrumbs::widget([
        'homeLink' => ['label' => 'Миндальная Роща', 'url' => '/'],
        'links' => $breadcrumbs,
        'itemTemplate'  =>  '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">{link}</li>' .PHP_EOL,
        'options' => [
            'class' => '',
            'itemtype'     => 'http://schema.org/BreadcrumbList',
            'itemscope'    => ''
        ]
    ]) ?>
*/
namespace frontend\widgets;

use yii\widgets\Breadcrumbs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use Yii;
use yii\helpers\Url;

class BreadcrumbsWidget extends Breadcrumbs
{
  protected function renderItem($link, $template)
  {
    $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);
    if (array_key_exists('label', $link)) {
      $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
    } else {
      throw new InvalidConfigException('The "label" element is required for each link.');
    }
    if (isset($link['template'])) {
      $template = $link['template'];
    }
    if (isset($link['url'])) {
      if ($link['url'] == Yii::$app->homeUrl){
        $url = str_replace('//', '/', Url::to([$link['url']]).'/');
      } else {
        $url = $link['url'];
      }
      $options = $link;
      unset($options['template'], $options['label'], $options['url']);
      $link = '<span itemprop="name">'.Html::a($label, $link['url'], $options).'</span><meta itemprop="position" content="item">';
    } else {
      $link = $label;
    }
    return strtr($template, ['{link}' => $link = str_replace('a href="', 'a itemprop="item" href="', $link)]);
  }
}
