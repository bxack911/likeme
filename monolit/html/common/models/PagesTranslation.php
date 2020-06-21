<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%pages_translation}}".
 *
 * @property integer $pages_id
 * @property string $language
 * @property string $title
 * @property string $content
 *
 * @property Page $page
 */
class PagesTranslation extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->db_other;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pages_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pages_id' => Yii::t('common/pages', 'Material'),
            'language' => Yii::t('common/pages', 'Language'),
            'title' => Yii::t('common/pages', 'Header'),
            'content' => Yii::t('common/pages', 'Header2'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::className(), ['id' => 'pages_id']);
    }
}
