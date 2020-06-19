<?php

namespace common\components;

use yii\base\BootstrapInterface;
use common\models\Module;

/**
 * ModulesBootstrap
 * Register modules stored in db to application
 */
class ModulesBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $models = Module::findAllActive();
        $modules = [];
        foreach ($models as $model) {
            /** @var Module $model */
            //$modules[$model->id] = (array) $model->getProperties();
            $modules[$model->id]['class'] = $model->class;
        }

        $app->setModules($modules);
    }
}