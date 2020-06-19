<?php

namespace common\modules\shop\common\models;

use common\models\Mediafiles;
use Yii;
use common\helpers\Upload;
use yii\web\UploadedFile;
use yii\helpers\Url;
use common\models\Language;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\behaviors\RoutableBehavior;
use common\behaviors\TransliterBehavior;
use creocoder\translateable\TranslateableBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use pendalf89\filemanager\behaviors\MediafileBehavior;

class Category extends \yii\db\ActiveRecord
{
  const STATUS_INACTIVE = 0;
  const STATUS_ACTIVE = 1;

  public $file;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%category}}';
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
        'translationAttributes' => ['title', 'description']
      ],
      [
        'class' => RoutableBehavior::className(),
        'defaultRoute' => 'shop/category/category'
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
        'type' => 'category',
        'extension' => 'jpg',
        'directory' => '/storage/gallery/category',
        'url' => '/storage/gallery/category',
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
      [['image','parent','depth','position'], 'integer'],
      [['status'],'boolean'],
      [['slug'], 'string', 'max' => 255],
      [['slug'], 'unique'],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'image' => 'Изображение страницы',
      'parent' => 'Родительская категория',
      'slug' => 'Ссылка',
      'status' => 'Активность',
      'route' => 'Роут',
    ];
  }

  /**
   * @inheritdoc
   * @return \common\models\query\MaterialQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new query\CategoryQuery(get_called_class());
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
    return $this->hasMany(CategoryTranslation::className(), ['category_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLanguages()
  {
    return $this->hasMany(Language::className(), ['code' => 'language'])->viaTable('{{%category_translation}}', ['category_id' => 'id']);
  }

  public function getTranslate()
  {
    return CategoryTranslation::find()->where(['category_id' => $this->id,'language' => Yii::$app->language])->one();
  }

  private function sort_cats($a,$b)
  {
    if ($a['depth'] == $b['depth']) {
      return 0;
    }
    return ($a['depth'] < $b['depth']) ? -1 : 1;
  }

  public function getUrl()
  {
    $segments = "";

    $id = $this->parent;
    $cats = [];

    while($cat = $this->find()->where(['id' => $id])->one()){
      $id = $cat->parent;
      $cats[] = [
        'slug' => $cat->slug,
        'depth' => $cat->depth
      ];
    }

    usort($cats, array($this,'sort_cats'));


      foreach ($cats as $index => $cat) {
        if ($index == 0) $segments = "/";

        $segments .= $cat['slug'] . "/";
      }

    return ($segments == "") ? '/' . $this->slug : $segments . $this->slug;
  }

  public function getDepth()
  {
    $depth = 0;
    $id = $this->parent;
    while($cat = self::find()->where(['id' => $id])->one()){
      $id = $cat->parent;
      $depth++;
    }

    return $depth;
  }

  public function getLink()
  {
    return Url::to([$this->url]);
  }

  public static function getCatBySlug($slug)
  {
    return self::find()->where(['slug' => $slug])->active()->one();
  }

  public function getBreadcrumbs()
  {
    $breadcrumbs = [];

    $id = $this->parent;
    $cats = [];

    while($cat = $this->find()->where(['id' => $id])->one()){
      $id = $cat->parent;
      $cats[] = [
        'slug' => $cat->slug,
        'depth' => $cat->depth,
        'title' => $cat->title,
        'link' => $cat->link
      ];
    }

    usort($cats, array($this,'sort_cats'));

    foreach($cats as $index => $cat)
    {
      array_push($breadcrumbs, [
        'label' => $cat['title'],
        'url' => $cat['link'],
      ]);
    }

    array_push($breadcrumbs, [
      'label' => $this->title,
    ]);

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
