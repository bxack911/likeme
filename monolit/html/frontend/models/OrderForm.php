<?php

namespace frontend\models;

use yii\base\Model;
use yii\helpers\Url;

class OrderForm extends Model
{
  public $model;
  public $fio;
  public $email;
  public $sum;
  public $phone;
  public $comment;
  public $date;
  public $delivery_id;
  public $paysystem_id;
  public $subject = "Заказ оформлен";

  public function rules(){
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

  public function attributeLabels()
  {
    return [
      'sum' => 'Сумма по товарам',
      'phone' => 'Контактный телефон',
      'fio' => 'ФИО',
      'date' => 'Дата оформления',
      'comment' => 'Комментарии к заказу',
      'email' => 'Email',
      'delivery_id' => 'Способ доставки',
      'paysystem_id' => 'Способ оплаты',
    ];
  }

  public function set($id)
  {
    $storage = \yii::$app->redis;
    $query = $storage->KEYS('*'.$_SERVER['REMOTE_ADDR'].'*');
    $cart = \yii::$container->get('Cart');

    foreach($query as $prod) {
      $cart::setOrder($id,$prod);
      $storage->del($prod);
    }

    return \yii::$app->response->redirect(Url::to(['/order/thanks']) . '?order=' . $id);
  }
}
