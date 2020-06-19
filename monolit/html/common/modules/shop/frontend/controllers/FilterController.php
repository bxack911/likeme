<?php

namespace common\modules\shop\frontend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\modules\shop\common\models\Products;
use common\modules\shop\common\models\Properties;

setlocale(LC_ALL, 'ru_RU.UTF-8');

class FilterController extends Controller
{
  public function actionGetFilters($param)
  {
    $data = [];

    foreach(Products::find()->where(['category' => $param])->active()->all() as $product) {
      foreach (Properties::find()->where(['product_id' => $product->id, 'parent' => null])->active()->all() as $property) {
        $data['props'][$property->id]['prop'] = [];
        $data['props'][$property->id]['prop'] = [
          'id' => $property->id,
          'product_id' => $property->product_id,
          'name' => $property->name,
          'value' => $property->value,
        ];

        $data['props'][$property->id]['childs'] = [];
        foreach (Properties::find()->where(['product_id' => $product->id, 'parent' => $property->id])->all() as $prop) {
          array_push($data['props'][$property->id]['childs'], [
            'id' => $prop->id,
            'product_id' => $property->product_id,
            'name' => $prop->name,
            'value' => $prop->value,
          ]);
        }
      }
    }

    $min_price = Products::find()->where(['category' => $param])->orderBy(['price' => SORT_DESC])->active()->one()->price;
    $max_price = Products::find()->where(['category' => $param])->orderBy(['price' => SORT_ASC])->active()->one()->price;

    $data['price'] = [
      'min' => (int)$min_price,
      'max' => (int)$max_price
    ];

    return json_encode($data, true);
  }

  public function actionSetFilters($param)
  {
    $data = [];

    $post = json_decode(file_get_contents("php://input"),true);

    if($post) {
      $min_price = $post['min_price'];
      $max_price = $post['max_price'];
      $props = $post['props'];
      $products_ids = [];

      if ($properties = Properties::find()->where(['id' => $props])->all()) {
        foreach ($properties as $property) {
          if (!in_array($property->id, $products_ids)) {
            array_push($products_ids, $property->product_id);
          }
        }
      }

      $products = [];
      if ($products_ids) {
        foreach ($products_ids as $product_id) {
          $product = Products::find()
            ->where(['between', 'price', $min_price, $max_price])
            ->andWhere(['id' => $product_id])
            ->active()->one();

          if ($product)
            array_push($products, $product->setProductArray());
        }
      } elseif ($post) {
        $product = Products::find()
          ->where(['between', 'price', $min_price, $max_price])
          ->active()->all();

        if ($product) {
          foreach ($product as $prod) {
            array_push($products, $prod->setProductArray());
          }
        }
      }
      return json_encode($products,true);
    }else{
      return null;
    }

  }

  private function set_product_array()
  {

  }

  public function beforeAction($action)
  {
    if($this->action->id == "set-filters") {
      $this->enableCsrfValidation = false;
    }

    return parent::beforeAction($action);
  }
}

?>
