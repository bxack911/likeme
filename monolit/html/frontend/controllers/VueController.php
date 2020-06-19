<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Units;
use common\models\Mediafiles;
use common\models\Blocks;
use common\modules\shop\common\models\Category;
use common\modules\shop\common\models\Products;

setlocale(LC_ALL, 'ru_RU.UTF-8');

class VueController extends Controller
{
    public function actionGetUnits($param)
    {
    	$units = Units::find()->where(['type' => $param])->all();

    	$data = [];


    	foreach($units as $key => $unit){
            $mediafile = Mediafiles::find()->where(['id' => $unit->image])->one();

    		array_push($data,[
    			'id' => $unit->id,
    			'image' => $mediafile->url,
    			'status' => $unit->status,
    			'link' => $unit->link,
    			'type' => $unit->type,
    			'title' => $unit->title,
    			'content' => $unit->content,
    			'content2' => $unit->content2,
    			'html2' => $unit->html2,
    			'html' => $unit->html,
    		]);
    	}

    	return json_encode($data, true);
    }

    public function actionSliderTranslations()
    {
      $data = [
        'button' => \yii::t('common','В каталог')
      ];
      return json_encode($data,true);
    }

    public function actionGetProductsImage2($param)
    {
      $product = Products::find()->where(['id' => $param])->one();

      return $product->getImage2(false);
    }

    public function actionGetProducts($param)
    {
      $products = null;
      if($param == "new"){
        $products = Products::find()->where(['is_new' => 1])->limit(8)->active()->all();
      }else {
        $products = Products::find()->where(['category' => $param])->active()->all();
      }

      $data = [];

      foreach($products as $product)
      {
        array_push($data, $product->setProductArray());
      }

      return json_encode($data,true);
    }

    public function actionGetCats($param)
    {
      $categories = Category::find()->where(['parent' => $param])->active()->all();

      $data = [];

      foreach ($categories as $category)
      {
        $mediafile = Mediafiles::find()->where(['id' => $category->image])->one();
        $product_quantity = Products::find()->where(['category' => $category->id])->count();

        array_push($data, [
          'id' => $category->id,
          'image' => $mediafile->url,
          'product_quantity' => $product_quantity,
          'title' => $category->title,
          'link' => $category->link
        ]);
      }

      return json_encode($data, true);
    }

    public function actionGetProductPage($param)
    {
      $product = Products::findActive($param);

      $data = [];

      array_push($data,$product->setProductArray(true));


      return json_encode($data, true);
    }

    public function actionHeaderBlocks()
    {
      $data = [];
      $header_left_label = Blocks::findOne(['name' => 'header_left_label'])->getTranslations()->one()->value;
      $header_right= Blocks::findOne(['name' => 'header_right'])->getTranslations()->one()->value;

      array_push($data,[
        'header_left' => $header_left_label,
        'header_right' => $header_right
      ]);

      return json_encode($data, true);
    }
}
