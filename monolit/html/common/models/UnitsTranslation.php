<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "units_translation".
 *
 * @property int $id
 * @property int $unit_id
 * @property string $language
 * @property string|null $title
 * @property string|null $content
 * @property string|null $content2
 * @property string|null $html
 */
class UnitsTranslation extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->db_other;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'units_translation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'content2', 'html', 'html2'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit_id' => 'Unit ID',
            'language' => 'Language',
            'title' => 'Title',
            'content' => 'Content',
            'content2' => 'Content2',
            'html' => 'Html',
            'html2' => 'Html2',
        ];
    }

    public function getUnits()
    {
        return $this->hasOne(Units::className(), ['id' => 'unit_id']);
    }
}
