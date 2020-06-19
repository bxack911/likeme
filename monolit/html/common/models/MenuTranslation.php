<?php

namespace common\models;

use Yii;

class MenuTranslation extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%menu_translation}}';
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'label' => 'Название',
    ];
  }

  public function getMenu()
  {
    return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
  }
}
