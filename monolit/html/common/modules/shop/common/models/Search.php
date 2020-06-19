<?php

namespace common\modules\shop\common\models;

class Search
{

  public static function getResults($key)
  {
    $data = [];

    $products = ProductsTranslation::find()->where(['like', 'title', $key])->andWhere(['language' => \yii::$app->language])->all();

    foreach ($products as $product){
      $prod = $product->products;
      $data[] = $prod->setProductArray();
    }

    return $data;
  }
}
