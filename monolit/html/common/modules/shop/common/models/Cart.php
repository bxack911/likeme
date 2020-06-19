<?php

namespace common\modules\shop\common\models;

use yii\base\Model;
use common\models\Mediafiles;

class Cart extends Model
{
  public static function increase($param)
  {
    $storage = \yii::$app->redis;

    $quantity = $storage->hget(self::className() . "__".$_SERVER['REMOTE_ADDR']."__" . $param . "__", "quantity");

    if($quantity){
      $storage->hset(self::className() . "__".$_SERVER['REMOTE_ADDR']."__" . $param . "__", 'quantity', $quantity + 1);
      return self::getCartArray($param);
    }else{
      return self::setCartung($param);
    }
  }

  public function decrease($param)
  {
    $storage = \yii::$app->redis;

    $quantity = $storage->hget(self::className() . "__".$_SERVER['REMOTE_ADDR']."__" . $param . "__", "quantity");

    if($quantity){
      $storage->hset(self::className() . "__".$_SERVER['REMOTE_ADDR']."__" . $param . "__", 'quantity', $quantity - 1);
      return self::getCartArray($param);
    }else{
      return self::setCartung($param);
    }
  }

  public function summ($param, $new_quantity)
  {
    $storage = \yii::$app->redis;

    $quantity = $storage->hget(self::className() . "__".$_SERVER['REMOTE_ADDR']."__" . $param . "__", "quantity");

    if($quantity){
      $storage->hset(self::className() . "__".$_SERVER['REMOTE_ADDR']."__" . $param . "__", 'quantity', $new_quantity);
      return self::getCartArray($param);
    }else{
      return self::setCartung($param, $new_quantity);
    }
  }

  public static function clearOrderCart($order_id)
  {
    $storage = \yii::$app->redis;
    $query = $storage->KEYS('*'.self::className().'__'.$_SERVER['REMOTE_ADDR'] . "__[^ORDER]".'*');
    foreach ($query as $order){
      $storage->del($order);
    }

    return true;
  }

  public static function clearCart($param)
  {
    $storage = \yii::$app->redis;
    $storage->del(self::className() . "__".$_SERVER['REMOTE_ADDR']."__" . $param . "__");

    return self::getCartArray($param);
  }

  public static function getQuantity($param)
  {
    $storage = \yii::$app->redis;

    return $storage->hget(self::className() . "__".$_SERVER['REMOTE_ADDR']."__" . $param . "__", 'quantity');
  }

  public static function getCartArray($product_id = null, $order_id = null)
  {
    $storage = \yii::$app->redis;

    $cart = [];
    $cart['products'] = [];
    $cart['cart'] = [];
    $sum = 0;
    $product_quantity = 0;

    $query = $storage->KEYS('*'.str_replace('\\','\\\\',self::className()).'__'.$_SERVER['REMOTE_ADDR'] . "__[^ORDER]".'*');

    if($order_id){
      $query = $storage->KEYS('*'.str_replace('\\','\\\\',self::className()).'__'.$_SERVER['REMOTE_ADDR'] . '__ORDER__'. $order_id .'*');
    }

    foreach($query as $prod)
    {
      $redis_product_id = $storage->hget($prod,'product_id');
      $redis_quantity = $storage->hget($prod,'quantity');
      $redis_sum = $storage->hget($prod,'sum');
      $redis_sum_discount = $storage->hget($prod,'sum_discount');
      $redis_user_ip = $storage->hget($prod,'user_ip');

      if($product_id){
        if($redis_product_id != $product_id) continue;
      }

      $product = Products::findActive($redis_product_id);
      $mediafile = Mediafiles::find()->where(['id' => $product->image])->one();

      $sum += ($redis_sum * $redis_quantity);

      array_push($cart['products'], [
        'id' => $product->id,
        'title' => $product->title,
        'link' => $product->link,
        'articul' => $product->articul,
        'price' => $product->price,
        'image' => $mediafile->url,
        'quantity' => $redis_quantity,
        'sum' => number_format($redis_sum * $redis_quantity, 2, ',', ' '),
        'sum_discount' => $redis_sum_discount,
      ]);

      $product_quantity += $redis_quantity;
    }

    if(!empty($cart['products'])) {
      array_push($cart['cart'], [
        'sum' => number_format($sum, 2, ',', ' '),
        'product_quantity' => $product_quantity,
      ]);
    }

    return json_encode($cart);
  }

  private static function setAttrs($redis_product_id,$array,$order_id = null)
  {
    $storage = \yii::$app->redis;
    $order = \yii::$container->get('Order');

    foreach ($array as $attr => $key) {
      if($order_id){
        $storage->hset($order::getRedisKey(self::className(), $redis_product_id, $order_id), $attr, $key);
      }else{
        $storage->hset($order::getRedisKey(self::className(), $redis_product_id), $attr, $key);
      }
    }
  }

  public static function setOrder($order_id,$key)
  {
    $storage = \yii::$app->redis;

    $data = [
      'product_id' => $storage->hget($key,'product_id'),
      'quantity' => $storage->hget($key,'quantity'),
      'sum' => $storage->hget($key,'sum'),
      'sum_discount' => $storage->hget($key,'sum_discount'),
      'user_ip' => $storage->hget($key,'user_ip')
    ];

    self::setAttrs($storage->hget($key,'product_id'),$data,$order_id);
  }

  public static function setCartung($param, $quantity = 1)
  {
    $product = Products::find()->where(['id' => $param])->one();

    $data = [
      'product_id' => $param,
      'quantity' => $quantity,
      'sum' => $product->price,
      'sum_discount' => $product->getDiscount('sum'),
      'user_ip' => $_SERVER['REMOTE_ADDR']
    ];

    self::setAttrs($param,$data);

    return self::getCartArray($param);
  }
}
