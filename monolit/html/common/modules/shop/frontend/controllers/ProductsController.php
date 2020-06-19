<?php

namespace common\modules\shop\frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\helpers\BreadcrumbsHelper;
use common\modules\shop\common\models\Products;

setlocale(LC_ALL, 'ru_RU.UTF-8');

class ProductsController extends Controller
{

  public function actionView($id)
  {
    $product = $this->findCategoryModel($id);
    $this->registerProductsMeta($product);

    return $this->render('view',[
      'breadcrumbs' => BreadcrumbsHelper::get($product->breadcrumbs),
      'product' => $product,
      'id' => $product->id
    ]);
  }

  protected function findCategoryModel($id)
  {
    if (($model = Products::findActive($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(t('Страница не найдена'));
    }
  }

  protected function registerProductsMeta($model)
  {
    $view = Yii::$app->view;

    $view->title = $model->title;
    $view->registerMetaTag(['name' => 'description', 'content' => '$description']);
  }
}
