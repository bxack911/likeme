<?php

namespace common\modules\shop\common\models\addons;

use Yii;
use common\models\Language;
use creocoder\translateable\TranslateableBehavior;
use common\modules\shop\common\models\query\PaysystemsQuery;

class Paysystems extends \yii\db\ActiveRecord
{
  
  public static function getDb() {
      return Yii::$app->db_orders;
  }
  public $file;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%paysystems}}';
  }
  public function behaviors()
  {
    return [
      'translateable' => [
        'class' => TranslateableBehavior::className(),
        'translationAttributes' => ['name', 'comment']
      ],
    ];
  }



  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['status'], 'boolean'],
      [['class'], 'string', 'max' => 150],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'status' => 'Активность',
      'class' => 'Класс обработчик(лезть только разрабам!)',
    ];
  }
  public static function find()
  {
    return new PaysystemsQuery(get_called_class());
  }

  public static function findActive($id)
  {
    return static::find()->where(['id' => $id])->active()->one();
  }

  public static function findAllActive()
  {
    return static::find()->active()->all();
  }

  public function getTranslations()
  {
    return $this->hasMany(PaysystemsTranslation::className(), ['paysystem_id' => 'id']);
  }

  public function getLanguages()
  {
    return $this->hasMany(Language::className(), ['code' => 'language'])->viaTable('{{%paysystems_translation}}', ['paysystem_id' => 'id']);
  }

  public function getTranslate()
  {
    return PaysystemsTranslation::find()->where(['paysystem_id' => $this->id,'language' => Yii::$app->language])->one();
  }

  public function getPaysystems()
  {
    return self::find()->active()->all();
  }

}
