<?php

namespace common\modules\shop\common\models;

use Yii;

class OrderCart extends \yii\db\ActiveRecord
{
  public static function getDb() {
      return Yii::$app->db_orders;
  }
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%cart}}';
  }


  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['order_id','product_id','quantity','sum','sum_discount'], 'required'],
      [['sum', 'sum_discount'], 'string', 'max' => 20],
      [['order_id','product_id','quantity'], 'integer']
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'order_id' => 'Id заказа',
      'product_id' => 'Id товара',
      'quantity' => 'Количество',
      'sum' => 'Сумма',
      'sum_discount' => 'Сумма со скидкой',
    ];
  }

  public function getProduct($id)
  {
    return Products::find()->where(['id' => $id])->one();
  }
}
