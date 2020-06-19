<?php

namespace common\modules\shop\frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\helpers\BreadcrumbsHelper;
use common\modules\shop\common\models\Category;
setlocale(LC_ALL, 'ru_RU.UTF-8');

class CategoryController extends Controller
{

  public function actionCatalog($id)
  {
    $category = $this->findCategoryModel($id);
    $this->registerPagesMeta($category);

    return $this->render('catalog',[
      'breadcrumbs' => BreadcrumbsHelper::get($category->breadcrumbs),
      'category' => $category
    ]);
  }

  public function actionCategory($id)
  {
    $category = $this->findCategoryModel($id);
    $this->registerPagesMeta($category);

    return $this->render('category',[
      'category' => $category,
      'breadcrumbs' => BreadcrumbsHelper::get($category->breadcrumbs),
      'id' => $category->id,
    ]);
  }

  protected function findCategoryModel($id)
  {
    if (($model = Category::findActive($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(t('Страница не найдена'));
    }
  }

  protected function registerPagesMeta($model)
  {
    $view = Yii::$app->view;

    $view->title = $model->title;
    $view->registerMetaTag(['name' => 'description', 'content' => '$description']);
  }
}
