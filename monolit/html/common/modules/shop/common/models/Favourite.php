<?php

namespace common\modules\shop\common\models;

use yii\base\Model;
use common\models\Mediafiles;

class Favourite extends Model
{
  public static function clearFavourite($param)
  {
    $storage = \yii::$app->redis;
    $order = \yii::$container->get('Order');
    $storage->del($order::getRedisKey(self::className(),$param));

    return self::getFavouriteArray($param);
  }

  public static function getFavouriteArray($product_id = null)
  {
    $storage = \yii::$app->redis;
    $order = \yii::$container->get('Order');

    $favourite = [];

    $query = $storage->KEYS($order::getRedisKey(self::className(),null,null,true));

    foreach($query as $prod)
    {
      $redis_product_id = $storage->hget($prod,'product_id');
      $redis_user_ip = $storage->hget($prod,'user_ip');

      if($product_id){
        if($redis_product_id != $product_id) continue;
      }

      $product = Products::findActive($redis_product_id);
      array_push($favourite, $product->setProductArray());
    }

    return $favourite;
  }

  private static function setAttrs($redis_product_id,$array)
  {
    $storage = \yii::$app->redis;
    $order = \yii::$container->get('Order');

    foreach ($array as $attr => $key) {
      $storage->hset($order::getRedisKey(self::className(), $redis_product_id), $attr, $key);
    }
  }

  public static function setFavourite($param)
  {
    $storage = \yii::$app->redis;
    $order = \yii::$container->get('Order');

    $data = [
      'product_id' => $param,
      'user_ip' => $_SERVER['REMOTE_ADDR']
    ];
    if($storage->KEYS($order::getRedisKey(self::className(),$param, null, true))){
      self::clearFavourite($param);
      return false;
    }else{
      self::setAttrs($param,$data);
      return true;
    }
  }
}
