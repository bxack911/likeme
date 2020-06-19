<?php

namespace common\modules\shop\common\models;

use Yii;
use common\helpers\Upload;
use creocoder\translateable\TranslateableBehavior;

class Properties extends \yii\db\ActiveRecord
{
  const STATUS_INACTIVE = 0;
  const STATUS_ACTIVE = 1;

  public $file;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%properties}}';
  }

  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
      'translateable' => [
        'class' => TranslateableBehavior::className(),
        'translationAttributes' => ['name', 'value']
      ],
    ];
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['product_id'], 'required'],
      [['parent'], 'integer'],
      [['status'],'boolean'],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'product_id' => 'Товар',
      'status' => 'Активность',
      'parent' => 'Родитель',
    ];
  }

  /**
   * @inheritdoc
   * @return \common\models\query\MaterialQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new query\ProductsQuery(get_called_class());
  }

  /**
   * Finds one active model
   * @param $id
   * @return array|null|Products
   */
  public static function findActive($id)
  {
    return static::find()->where(['id' => $id])->active()->one();
  }

  /**
   * Find all active models
   * @return array|Products[]
   */
  public static function findAllActive()
  {
    return static::find()->active()->all();
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTranslations()
  {
    return $this->hasMany(PropertiesTranslation::className(), ['property_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLanguages()
  {
    return $this->hasMany(Language::className(), ['code' => 'language'])->viaTable('{{%properties_translation}}', ['property_id' => 'id']);
  }

  public function getTranslate()
  {
    return PropertiesTranslation::find()->where(['property_id' => $this->id,'language' => Yii::$app->language])->one();
  }
}
