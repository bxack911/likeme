<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

//$user_role = key(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()));

/**
 * Module model
 *
 * @property string $id
 * @property string $class
 * @property string $title
 * @property string $properties
 * @property string icon
 * @property integer $sort_order
 * @property integer is_installed
 * @property integer $status
 * @property string $version
 *
 * @property \yii\base\Module $instance
 */
class Module extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const STATE_INSTALLED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%module}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'icon', 'version'], 'string', 'max' => 64],
            [['class', 'title'], 'string', 'max' => 255],
            [['properties'], 'string'],
            [['sort_order', 'status'], 'integer'],
            [['id', 'class'], 'unique'],
            [['id', 'class'], 'required'],
            [['is_installed'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('common/module', 'Title'),
            'icon' => Yii::t('common/module', 'Icon'),
            'version' => Yii::t('common/module', 'Version')
        ];
    }

    public static function findAllActive()
    {
        return static::find()->where(['status' => static::STATUS_ACTIVE, 'is_installed' => static::STATE_INSTALLED])->all();
    }

    public static function getAsMenu()
    {
        $items = [];
        foreach (static::findAllActive() as $model) {
            /** @var $model Module */
            $instance = $model->instance;
            if(Yii::$app->user->can($model->properties)){
                if(method_exists($instance, 'getBackendMenu')) {
                    $items[] = ['label' => '<i class="'.$model->icon.'"></i> <span>' . Yii::t('backend/module', $model->title) . '</span>', 'url' => ['/' . $model->id],
                        'items' => $instance::getBackendMenu()
                    ];
                } else {
                    $items[] = ['label' => '<i class="'.$model->icon.'"></i> <span>' . Yii::t('backend/module', $model->title) . '</span>', 'url' => ['/' . $model->id]];
                }
            }
        }

        return $items;
    }

    /**
     * Retrieves the module using ID
     * @return \yii\base\Module|null
     */
    public function getInstance()
    {
        return Yii::$app->getModule($this->id);
    }

    public function setProperties()
    {

    }

    public function getProperties()
    {
        return json_encode($this->properties);
    }

}