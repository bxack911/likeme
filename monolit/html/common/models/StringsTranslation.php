<?php

namespace common\models;

use Yii;

class StringsTranslation extends \yii\db\ActiveRecord
{
  public static function getDb() {
    return Yii::$app->db_other;
  }
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%strings_translation}}';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'value' => Yii::t('common/strings', 'Value'),
      'language' => Yii::t('common/pages', 'Language'),
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getString()
  {
    return $this->hasOne(Strings::className(), ['id' => 'string_id']);
  }
}
