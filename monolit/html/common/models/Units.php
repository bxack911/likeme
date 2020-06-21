<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\behaviors\TransliterBehavior;
use creocoder\translateable\TranslateableBehavior;
use pendalf89\filemanager\behaviors\MediafileBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use common\models\Mediafiles;

/**
 * This is the model class for table "units".
 *
 * @property int $id
 * @property string $image
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property string $slug
 */
class Units extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->db_other;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'units';
    }

    public function behaviors(){
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
            'translateable' => [
                'class' => TranslateableBehavior::className(),
                'translationAttributes' => ['title', 'content', 'content2', 'html', 'html2']
            ],
            'mediafile' => [
                'class' => MediafileBehavior::className(),
                'name' => 'image',
                'attributes' => [
                    'image',
                ],
            ],
           'galleryBehavior' => [
                 'class' => GalleryBehavior::className(),
                 'type' => 'units',
                 'extension' => 'jpg',
                 'directory' => Yii::getAlias('@webroot') . '/storage/gallery/units',
                 'url' => Yii::getAlias('@web') . '/storage/gallery/units',
                 'versions' => [
                     'small' => function ($img) {
                         /** @var \Imagine\Image\ImageInterface $img */
                         return $img
                             ->copy()
                             ->thumbnail(new \Imagine\Image\Box(200, 200));
                     },
                     'medium' => function ($img) {
                         /** @var \Imagine\Image\ImageInterface $img */
                         $dstSize = $img->getSize();
                         $maxWidth = 800;
                         if ($dstSize->getWidth() > $maxWidth) {
                             $dstSize = $dstSize->widen($maxWidth);
                         }
                         return $img
                             ->copy()
                             ->resize($dstSize);
                     },
                 ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'type'], 'integer'],
            [['image', 'created_at', 'updated_at', 'created_by', 'updated_by', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Изображение',
            'status' => 'Статус',
            'type' => 'Тип',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'link' => 'Link',
        ];
    }

    public static function findActive($id)
    {
        return static::find()->where(['id' => $id])->active()->one();
    }

    public static function findAllActive()
    {
        return static::find()->active()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(UnitsTranslation::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(Language::className(), ['code' => 'language'])->viaTable('{{%units_translation}}', ['unit_id' => 'id']);
    }

    public function getTranslate()
    {
        return PagesTranslation::find()->where(['unit_id' => $this->id,'language' => Yii::$app->language])->one();
    }
}
