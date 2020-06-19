<?php

namespace common\modules\shop\common\models;

use Yii;

class CategoryTranslation extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%category_translation}}';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'category_id' => Yii::t('common/shop', 'Category'),
      'language' => Yii::t('common/pages', 'Language'),
      'title' => 'Заголовок',
      'description' => 'Описание',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getProducts()
  {
    return $this->hasOne(Category::className(), ['id' => 'category_id']);
  }
}
