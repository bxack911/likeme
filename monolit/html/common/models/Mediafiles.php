<?php

namespace common\models;

use Yii;
use common\helpers\Upload;
use yii\web\UploadedFile;
use yii\helpers\Url;

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
class Mediafiles extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->db;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%filemanager_mediafile}}';
    }

    public function rules(){
        return [
            [['filename','type','url','alt','size','description','thumbs','created_at','updated_at'], 'self']
        ];
    }
}
