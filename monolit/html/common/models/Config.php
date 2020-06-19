<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use creocoder\translateable\TranslateableBehavior;
use common\models\Language;

/**
 * This is the model class for table "{{%config_item}}".
 *
 * @property string $key
 * @property string $value
 * @property string $comment
 * @property integer $created_at
 * @property integer $updated_at
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['comment'], 'string'],
            [['key'], 'string', 'max' => 128],
            [['value','created_at','updated_at','created_by','updated_by'], 'string', 'max' => 255],
            [['key'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => 'Key',
            'value' => 'Value',
            'comment' => 'Comment',
        ];
    }

    public static function findByKey($key)
    {
        return static::find()->where(['key' => $key])->one();
    }

    public static function findByEmail($key)
    {
        if(static::find()->where(['key' => $key])->one()->value){
            return static::find()->where(['key' => $key])->one();
        } else {
            return static::find()->where(['key' => 'email_defaulte'])->one();
        }
    }

    public static function bookingEmail(){
        $email_booking = Config::findByEmail('email_booking')->value;
        $email_defaulte = Config::findByEmail('email_defaulte')->value;
        if($email_booking != ''){
            $adminEmail = explode(',',$email_booking);
        } else {
            $adminEmail = explode(',',$email_defaulte);
        }
        return $adminEmail;
    }

    public static function guestbookEmail(){
        $email_questbook = Config::findByEmail('email_questbook')->value;
        $email_defaulte = Config::findByEmail('email_defaulte')->value;
        if($email_questbook != ''){
            $adminEmail = explode(',',$email_booking);
        } else {
            $adminEmail = explode(',',$email_defaulte);
        }
        return $adminEmail;
    }

    public static function defualtEmail(){
        $email_defaulte = Config::findByEmail('email_defaulte')->value;
        $adminEmail = explode(',',$email_defaulte);
        return $adminEmail;
    }
}
