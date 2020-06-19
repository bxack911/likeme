<?php

namespace common\models;

use Yii;
use common\helpers\Upload;
use yii\helpers\Url;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\behaviors\RoutableBehavior;
use creocoder\translateable\TranslateableBehavior;

/**
 * This is the model class for table "{{%material}}".
 *
 * @property integer $id
 * @property string $slug
 *
 * @property string $url
 * @property string $link
 * @property string $breadcrumbs
 *
 * MaterialTranslation model properties
 * @property string $title
 * @property string $content
 */
class Blocks extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blocks}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
            //SluggableBehavior::className()
            'translateable' => [
                'class' => TranslateableBehavior::className(),
                'translationAttributes' => ['title', 'content']
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','created_at','updated_at','created_by','updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => 'Key',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\MaterialQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new query\PagesQuery(get_called_class());
    }

    /**
     * Finds one active model
     * @param $id
     * @return array|null|Material
     */
    public static function findActive($id)
    {
        return static::find()->where(['id' => $id])->active()->one();
    }

    /**
     * Find all active models
     * @return array|Material[]
     */
    public static function findAllActive()
    {
        return static::find()->active()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(BlocksTranslation::className(), ['block_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(Language::className(), ['code' => 'language'])->viaTable('{{%blocks_translation}}', ['block_id' => 'id']);
    }

    public function getByName($name)
    {
      return Blocks::findOne(['name' => $name])->getTranslations()->one()->value;
    }
}
