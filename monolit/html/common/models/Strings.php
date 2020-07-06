<?php

namespace common\models;

use Yii;
use common\helpers\Upload;
use creocoder\translateable\TranslateableBehavior;

class Strings extends \yii\db\ActiveRecord
{
  public static function getDb() {
    return Yii::$app->db_other;
  }

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%strings}}';
  }

  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
      'translateable' => [
        'class' => TranslateableBehavior::className(),
        'translationAttributes' => ['value']
      ],
    ];
  }

  public function rules()
  {
    return [
      [['str_key'], 'required'],
      [['str_key'], 'string', 'max' => 500],
    ];
  }

  public function attributeLabels()
  {
    return [
      'str_key' => 'Ключ строки',
    ];
  }

  public function getTranslations()
  {
    return $this->hasMany(StringsTranslation::className(), ['string_id' => 'id']);
  }

  public function getLanguages()
  {
    return $this->hasMany(Language::className(), ['code' => 'language'])->viaTable('{{%strings_translation}}', ['string_id' => 'id']);
  }

  public function getTranslate()
  {
    return StringsTranslation::find()->where(['string_id' => $this->id,'language' => Yii::$app->language])->one();
  }
}
