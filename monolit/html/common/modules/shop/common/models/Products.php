<?php

namespace common\modules\shop\common\models;

use Yii;
use yii\helpers\Url;
use common\helpers\Upload;
use common\models\Mediafiles;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\behaviors\RoutableBehavior;
use common\behaviors\TransliterBehavior;
use creocoder\translateable\TranslateableBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use common\modules\filemanager\behaviors\MediafileBehavior;

/**
 * This is the model class for table "{{%products}}".
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
class Products extends \yii\db\ActiveRecord
{
  
  public static function getDb() {
      return Yii::$app->db;
  }
  const STATUS_INACTIVE = 0;
  const STATUS_ACTIVE = 1;

  public $file;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%products}}';
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
        'translationAttributes' => ['title', 'description', 'short_description']
      ],
      [
        'class' => RoutableBehavior::className(),
        'defaultRoute' => 'shop/products/view'
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
        'type' => 'products',
        'extension' => 'jpg',
        'directory' => Yii::getAlias('@root') . '/storage/gallery/products',
        'url' => '/storage/gallery/products',
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
      [['slug', 'articul'], 'required'],
      [['quantity','image','category','discount','discount_type'], 'integer'],
      [['status','is_new'],'boolean'],
      [['articul'], 'string', 'max' => 10],
      [['price'], 'string', 'max' => 10],
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
      'category' => 'Категория',
      'slug' => 'Ссылка',
      'price' => 'Цена',
      'discount' => 'Скидка',
      'discount_type' => 'Тип скидки',
      'status' => 'Активность',
      'route' => 'Роут',
      'is_new' => 'Новинка',
      'articul' => 'Артикул',
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

  public function getSection()
  {
    return $this->hasOne(Section::className(), ['id' => 'section_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTranslations()
  {
    return $this->hasMany(ProductsTranslation::className(), ['product_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getLanguages()
  {
    return $this->hasMany(Language::className(), ['code' => 'language'])->viaTable('{{%products_translation}}', ['product_id' => 'id']);
  }

  public function getTranslate()
  {
    return ProductsTranslation::find()->where(['product_id' => $this->id,'language' => Yii::$app->language])->one();
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

    $id = $this->category;
    $cats = [];

    while($cat = Category::find()->where(['id' => $id])->one()){
      $id = $cat->parent;
      $cats[] = [
        'slug' => $cat->slug,
        'depth' => $cat->depth
      ];
    }

    usort($cats, array($this,'sort_cats'));

    foreach($cats as $index => $cat)
    {
      if($index == 0) $segments = "/";

      $segments .= $cat['slug'] . "/";
    }

    return $segments . $this->slug;
  }

  public function getLink()
  {
    return Url::to([$this->url]);
  }

  public function getAvailable()
  {
    return ($this->quantity == 0) ? 0 : 1;
  }

  public function getDiscount($type = 'label')
  {
    if($this->discount === null) return false;

    switch($this->discount_type)
    {
        case 1:
          $discount = $this->price * $this->discount / 100;
          if( $type == 'label' )
            return $this->discount  . "%";
          else
            return $this->price - $discount;
        break;
        case 2:
          if( $type == 'label' )
            return $this->discount . " грн.";
          else
            return $this->price - $this->discount;
        break;
    }
  }

  public function getBreadcrumbs()
  {
    $breadcrumbs = [];

    $id = $this->category;
    $cats = [];

    while($cat = Category::find()->where(['id' => $id])->one()){
      $id = $cat->parent;
      $cats[] = [
        'title' => $cat->title,
        'link' => $cat->link,
        'slug' => $cat->slug,
        'depth' => $cat->depth
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

  public function getImage2($gallery = false)
  {
    if($gallery){
      $image2 = [];
      $mediafile = Mediafiles::find()->where(['id' => $this->image])->one();
      array_push($image2,['url' => $mediafile->url]);
      foreach($this->getBehavior('galleryBehavior')->getImages() as $index => $image){
        array_push($image2,['url' => $image->getUrl('medium')]);
      }
      return $image2;
    }else {
      foreach ($this->getBehavior('galleryBehavior')->getImages() as $index => $image) {
        if ($index == 1) break;
        return $image->getUrl('medium');
      }
    }
  }

  public function setProductArray($gallery = false)
  {
    $image2 = null;
    $image = null;
    if($gallery) {
      $image2 = $this->getImage2(true);
    }else{
      $image = Mediafiles::find()->where(['id' => $this->image])->one()->url;
      $image2 = $this->getImage2();
    }

    return [
      'id' => $this->id,
      'title' => $this->title,
      'image' => $image,
      'image2' => $image2,
      'articul' => $this->articul,
      'description' => $this->description,
      'short_description' => $this->short_description,
      'available' => $this->available,
      'price' => $this->price,
      'link' => $this->link,
      'prod_discount' => $this->discount,
      'discount_sum' => $this->getDiscount('sum'),
      'discount' => $this->getDiscount(),
    ];
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
