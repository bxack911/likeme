<?php

namespace common\models;

use Yii;
use common\helpers\Upload;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\behaviors\RoutableBehavior;
use common\behaviors\TransliterBehavior;
use creocoder\translateable\TranslateableBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use pendalf89\filemanager\behaviors\MediafileBehavior;
use common\models\Mediafiles;

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
class Pages extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->db_other;
    }
    
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pages}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
            TransliterBehavior::className(),
            'translateable' => [
                'class' => TranslateableBehavior::className(),
                'translationAttributes' => ['title', 'content']
            ],
            [
                'class' => RoutableBehavior::className(),
                'defaultRoute' => 'pages/view'
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
                 'type' => 'pages',
                 'extension' => 'jpg',
                 'directory' => '/storage/gallery/pages',
                 'url' => '/storage/gallery/pages',
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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug'], 'required'],
            [['section_id'], 'integer'],
            [['status'],'boolean'],
            [['slug','url','created_at','updated_at','created_by','updated_by'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file' => 'Изображение страницы',
            'image' => 'Изображение страницы',
            'slug' => 'Slug',
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

    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(PagesTranslation::className(), ['pages_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(Language::className(), ['code' => 'language'])->viaTable('{{%pages_translation}}', ['pages_id' => 'id']);
    }

    public function getTranslate()
    {
        return PagesTranslation::find()->where(['pages_id' => $this->id,'language' => Yii::$app->language])->one();
    }

    public function getUrl()
    {
        return ($this->section !== null ? '/' . $this->section->slug : '') . '/' . $this->slug;
    }

    public function getLink()
    {
        return Url::to([$this->url]);
    }

    public function getBreadcrumbs()
    {
        $breadcrumbs = [];
        if($this->section !== null) {
            $breadcrumbs[] = [
                'label' => $this->section->title,
                'url' => $this->section->link,
            ];
        }
        $breadcrumbs[] = ['label' => $this->title];

        return $breadcrumbs;
    }

    public static function getImageUrl($image)
    {
        if( $mediafile = Mediafiles::find()->where(['id' => $image])->one() ){
            return $mediafile->url;
        }else{
            return false;
        }
    }
}
