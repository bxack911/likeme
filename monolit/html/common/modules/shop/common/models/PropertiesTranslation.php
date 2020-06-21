<?php

namespace common\modules\shop\common\models;

use Yii;

class PropertiesTranslation extends \yii\db\ActiveRecord
{
  
  public static function getDb() {
        return Yii::$app->db;
    }
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%properties_translation}}';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'name' => 'Название',
      'value' => 'Значение',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getProperties()
  {
    return $this->hasOne(Properties::className(), ['id' => 'property_id']);
  }
}
