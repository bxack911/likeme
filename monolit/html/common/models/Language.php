<?php

namespace common\models;

use Yii;
use common\helpers\Upload;

/**
 * This is the model class for table "{{%language}}".
 *
 * @property string $code
 * @property string $title
 * @property string $locale
 * @property string $icon
 * @property integer $status
 * @property integer $sort_order
 * @property integer $updated_at
 * @property integer $updated_by
 */
class Language extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%language}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'locale', 'title'], 'required'],
            [['status', 'sort_order', 'updated_at', 'updated_by'], 'integer'],
            [['code', 'locale'], 'string', 'max' => 8],
            [['title'], 'string', 'max' => 255],
            [['code'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_INACTIVE, self::STATUS_ACTIVE]]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'locale' => 'Locale',
            'title' => 'Title',
            'status' => 'Status',
            'sort_order' => 'Sort Order',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'imageFile' => 'Icon',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\LanguageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new query\LanguageQuery(get_called_class());
    }

    public static function findAllActive()
    {
        return static::find()->active()->all();
    }

    public static function findAllExcludeCurrent()
    {
        return static::find()->active()->where(['<>' ,'code', Yii::$app->language])->all();
    }
}
