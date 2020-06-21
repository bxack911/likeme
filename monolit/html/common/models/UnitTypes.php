<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "unit_types".
 *
 * @property int $id
 * @property string $name
 */
class UnitTypes extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->db_other;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
}
