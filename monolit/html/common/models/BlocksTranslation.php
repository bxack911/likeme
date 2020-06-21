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
class BlocksTranslation extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->db_other;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blocks_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'block' => Yii::t('common/blocks', 'Blocks'),
            'language' => Yii::t('common/blocks', 'Language'),
            'value' => Yii::t('common/blocks', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(Material::className(), ['id' => 'block_id']);
    }
}
