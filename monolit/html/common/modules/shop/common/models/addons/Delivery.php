<?php

namespace common\modules\shop\common\models\addons;

use Yii;
use common\models\Language;
use creocoder\translateable\TranslateableBehavior;
use common\modules\shop\common\models\query\DeliveryQuery;

class Delivery extends \yii\db\ActiveRecord
{

  public $file;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%delivery}}';
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
      [['sum'], 'integer'],
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
      'sum' => 'Сума',
      'class' => 'Класс обработчик(лезть только разрабам!)',
    ];
  }
  public static function find()
  {
    return new DeliveryQuery(get_called_class());
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
    return $this->hasMany(DeliveryTranslation::className(), ['delivery_id' => 'id']);
  }

  public function getLanguages()
  {
    return $this->hasMany(Language::className(), ['code' => 'language'])->viaTable('{{%delivery_translation}}', ['delivery_id' => 'id']);
  }

  public function getTranslate()
  {
    return DeliveryTranslation::find()->where(['delivery_id' => $this->id,'language' => Yii::$app->language])->one();
  }

  public function getDeliveries()
  {
    return self::find()->active()->all();
  }

}
