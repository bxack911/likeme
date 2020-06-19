<?php

namespace common\modules\shop\common\models;

use frontend\models\OrderForm;
use common\modules\shop\common\models\addons\Delivery;
use common\modules\shop\common\models\addons\Paysystems;

class Order extends \yii\db\ActiveRecord
{

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%orders}}';
  }


  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['fio','sum','delivery_id','paysystem_id', 'phone'], 'required'],
      [['fio', 'email'], 'string', 'max' => 150],
      ['email', 'email'],
      [['sum'], 'string', 'max' => 15],
      [['phone','date'], 'string', 'max' => 20],
      ['comment', 'string'],
      [['delivery_id', 'paysystem_id'], 'integer']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'sum' => 'Сума',
      'date' => 'Дата оформления',
      'status' => 'Статус заказа',
      'phone' => 'Телефон',
      'fio' => 'ФИО',
      'comment' => 'Комментарии к заказу',
      'email' => 'Email',
      'delivery_id' => 'Способ доставки',
      'paysystem_id' => 'Способ оплаты',
    ];
  }

  public static function initialize($order_id = null)
  {
    $paysystems = Paysystems::getPaysystems();
    $deliveries= Delivery::getDeliveries();
    $cart = ($order_id) ? json_decode(\yii::$container->get('Cart')->getCartArray(null,$order_id)) : json_decode(\yii::$container->get('Cart')->getCartArray());

    $orderForm = new OrderForm();

    \yii::$container->set($orderForm->formName(),$orderForm::className());
    $orderForm->model = $orderForm->formName();
    $labels = $orderForm->attributeLabels();

    return [
      'cart' => $cart,
      'labels' => $labels,
      'paysystems' => $paysystems,
      'deliveries' => $deliveries,
      'orderForm' => $orderForm,
    ];
  }

  public static function getOrder($id)
  {
    $order = self::find()->where(['id' => $id])->one();

    $paysystem = Paysystems::find()->where(['id' => $order->paysystem_id])->one();
    $delivery = Delivery::find()->where(['id' => $order->delivery_id])->one();
    $cart = json_decode(\yii::$container->get('Cart')->getCartArray(null, $id));

    return [
      'order' => $order,
      'paysystem' => $paysystem,
      'delivery' => $delivery,
      'cart' => $cart
    ];
  }

  private static function setRedisSlashes($str, $slashes = false)
  {
    return (!$slashes) ? $str : str_replace('\\', '\\\\', $str);
  }

  public static function getRedisKey($classname, $product_id = null, $order_id = null, $slashes = false)
  {
    if($product_id) {
      return ($order_id) ? self::setRedisSlashes($classname,$slashes) . "__" . $_SERVER['REMOTE_ADDR'] . "__ORDER__" . $order_id . "__" . $product_id . "__"
        : self::setRedisSlashes($classname,$slashes) . "__" . $_SERVER['REMOTE_ADDR'] . "__" . $product_id . "__";
    }else{
      return "*" . self::setRedisSlashes($classname,$slashes) . "__" . $_SERVER['REMOTE_ADDR'] . "__*";
    }
  }
}