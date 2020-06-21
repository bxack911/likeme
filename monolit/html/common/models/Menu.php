<?php
namespace common\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;
use creocoder\translateable\TranslateableBehavior;

class Menu extends \kartik\tree\models\Tree
{
  public static function getDb() {
        return Yii::$app->db_other;
    }
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'menu';
  }


  /**
   * Override isDisabled method if you need as shown in the
   * example below. You can override similarly other methods
   * like isActive, isMovable etc.
   */
  public function isDisabled()
  {
    return parent::isDisabled();
  }


  public function behaviors()
  {
    $behaviours = parent::behaviors();
    $behaviours['translateable'] = [
      'class' => TranslateableBehavior::className(),
      'translationAttributes' => ['label']
    ];
    $behaviours['tree'] = [
      'class' => NestedSetsBehavior::className(),
      'treeAttribute' => 'root',
      'leftAttribute' => 'lft',
      'rightAttribute' => 'rgt',
      'depthAttribute' => 'lvl',
    ];
    return $behaviours;
  }

  public function transactions()
  {
    return [
      self::SCENARIO_DEFAULT => self::OP_ALL,
    ];
  }

  public static function find()
  {
    return new query\MenuQuery(get_called_class());
  }

  public function rules()
  {
    $rules = parent::rules();
    $rules[] = ['url', 'string', 'max' => 100];
    return $rules;
  }

  public function attributeLabels()
  {
    $attr = parent::attributeLabels();
    $attr['url'] = 'Ссылка';
    return $attr;
  }

  public function getTranslations()
  {
    return $this->hasMany(MenuTranslation::className(), ['menu_id' => 'id']);
  }

  public function getTranslate()
  {
    return MenuTranslation::find()->where(['menu_id' => $this->id,'language' => Yii::$app->language])->one();
  }

  public function beforeSave($insert)
  {
    if(parent::beforeSave($insert)){
      if(Yii::$app->request->post('MenuTranslation', [])) {
        $inserted = [];
        foreach (Yii::$app->request->post('MenuTranslation', []) as $language => $data) {
          foreach ($data as $attribute => $translation) {
            $inserted[] = [
              'language' => $language,
              $attribute => $translation
            ];

            $this->translate($language)->$attribute = $translation;
          }
        }
      }
      return true;
    }else{
      return false;
    }
  }
}
