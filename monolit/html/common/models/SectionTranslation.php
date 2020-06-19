<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%section_translation}}".
 *
 * @property integer $section_id
 * @property string $language
 * @property string $content
 *
 */
class SectionTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%section_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'section_id' => Yii::t('common/section', 'Section'),
            'language' => Yii::t('common/section', 'Language'),
            'header' => Yii::t('common/section', 'Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'section_id']);
    }
}
