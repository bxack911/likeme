<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\behaviors\RoutableBehavior;
use creocoder\translateable\TranslateableBehavior;

/**
 * This is the model class for table "{{%section}}".
 *
 * @property integer $id
 * @property string $slug
 * @property integer $status
 * @property integer $materials_per_page
 * @property integer $actions_ids
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property string $url
 * @property string $link
 * @property string $breadcrumbs
 *
 * SectionTranslation model properties
 * @property string $header
 * @property string $header2
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property string $enable_mta_title
 * @property string $enable_mta_keywords
 * @property string $enable_mta_description
 * @property string $mta_title
 * @property string $mta_keywords
 * @property string $mta_description
 *
 * @property SectionTranslation[] $categoryTranslations
 * @property Language[] $languages
 */
class Section extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->db_other;
    }
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $imageFile;

    /**
     * MTA - Meta tags on the algorithm
     */
    const NOT_USE_MTA = 0;
    const USE_MTA = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%section}}';
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
                'translationAttributes' => [
                    'title', 'content'
                ]
            ],
            [
                'class' => RoutableBehavior::className(),
                'defaultRoute' => 'section/view'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug'], 'required'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'slug' => Yii::t('common/section', 'Slug'),
            'materials_per_page' => Yii::t('common/section', 'Materials per page'),
            'status' => Yii::t('common/section', 'Status'),
            'imageFile' => Yii::t('common/material', 'Image'),
            'created_at' => Yii::t('common/section', 'Created At'),
            'updated_at' => Yii::t('common/section', 'Updated At'),
            'created_by' => Yii::t('common/section', 'Created By'),
            'updated_by' => Yii::t('common/section', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(SectionTranslation::className(), ['section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(Language::className(), ['code' => 'language'])->viaTable('{{%section_translation}}', ['section_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\SectionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new query\SectionQuery(get_called_class());
    }

    /**
     * Finds one active model
     * @param $id
     * @return array|null|Section
     */
    public static function findActive($id)
    {
        return static::find()->where(['id' => $id])->active()->one();
    }

    /**
     * Find all active models
     * @return array|Section[]
     */
    public static function findAllActive()
    {
        return static::find()->active()->all();
    }

    public function getUrl()
    {
        return '/' . $this->slug;
    }

    public function getLink()
    {
        return Url::to([$this->url]);
    }

    public function getBreadcrumbs()
    {
        return [
            ['label' => $this->header]
        ];
    }
}
