<?php

namespace common\modules\shop;

use Yii;
use yii\base\Module;
use yii\web\Application;
use backend\components\BackendApplicationn;

class ShopModule extends Module
{

  public $controllerNamespace = 'common\modules\shop\frontend\controllers';

  public function init()
  {
    parent::init();
    if (Yii::$app->id == "app-backend") {
      $this->controllerNamespace = 'common\modules\shop\backend\controllers';
      $this->viewPath = '@common/modules/shop/backend/views';
      $this->defaultRoute = 'shop/catalog';
    } else if(Yii::$app instanceof Application) {
      $this->controllerNamespace = 'common\modules\shop\frontend\controllers';
      $this->viewPath = '@common/modules/shop/frontend/views';
    }

    $this->registerTranslations();
  }

  public function registerTranslations()
  {
    Yii::$app->i18n->translations['modules/shop/*'] = [
      'class' => 'yii\i18n\PhpMessageSource',
      'sourceLanguage' => 'en',
      'basePath' => '@common/modules/shop/common/messages',
      'fileMap' => [
        'modules/shop' => 'shop.php',
      ],
    ];
  }

}
