<?php

namespace common\modules\shop\common\models;

use Yii;

class ProductsTranslation extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%products_translation}}';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'products_id' => Yii::t('common/shop', 'Products'),
      'language' => Yii::t('common/pages', 'Language'),
      'title' => 'Заголовок',
      'description' => 'Описание',
      'short_description' => 'Краткое описание',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getProducts()
  {
    return $this->hasOne(Products::className(), ['id' => 'product_id']);
  }
}
