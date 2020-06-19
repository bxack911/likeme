<?php

namespace common\modules\shop\common\models\addons;

use Yii;

class DeliveryTranslation extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%delivery_translation}}';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'name' => 'Название',
      'language' => Yii::t('common/pages', 'Language'),
      'comment' => 'Описание',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getDelivery()
  {
    return $this->hasOne(Delivery::className(), ['id' => 'delivery_id']);
  }
}
