<?php

namespace common\behaviors;

use Yii;
use common\models\Routes;
use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

/**
 * RoutableBehavior
 *
 * @property Route $route
 * @property ActiveRecord $owner
 */
class RoutableBehavior extends Behavior
{
    /**
     * @var string url attribute name
     */
    public $urlAttribute = 'url';
    /**
     * @var string
     */
    public $defaultRoute;
    /**
     * @var Routes
     */
    private $_route;

    public function init()
    {
        if($this->defaultRoute === null) {
            throw new InvalidConfigException("Set [defaultRoute] property");
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    public function getRoute()
    {
        if(!$this->_route) {
            $this->_route = $this->owner->hasOne(Routes::className(), ['model_id' => $this->owner->primaryKey()[0]])
                ->where([Routes::tableName().'.model' => get_class($this->owner)])->one();

            if(!$this->_route) {
                $this->_route = new Routes([
                    'model' => get_class($this->owner),
                    'model_id' => $this->owner->primaryKey,
                ]);
            }
        }

        return $this->_route;
    }

    public function afterSave()
    {
        $this->route->load(Yii::$app->request->post());
        $this->route->url = ltrim($this->owner->{$this->urlAttribute}, '/');
        $this->route->save(false);
    }

    public function afterDelete()
    {
        if(!$this->route->isNewRecord) {
            $this->route->delete();
        }
    }
}