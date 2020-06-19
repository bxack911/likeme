<?php

namespace common\modules\shop\frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Pages;
use common\helpers\BreadcrumbsHelper;
use common\modules\shop\common\models\Favourite;

setlocale(LC_ALL, 'ru_RU.UTF-8');

class FavouriteController extends Controller
{
  public function actionFavouritePage($id)
  {
    $favourite = $this->findCartModel($id);
    $this->registerPagesMeta($favourite);

    $model = Favourite::getFavouriteArray();

    return $this->render('favourite', [
      'breadcrumbs' => BreadcrumbsHelper::get($favourite->breadcrumbs),
      'favourite' => $favourite,
      'model' => $model,
    ]);
  }

  public function actionFavourite()
  {
    $favourite = Favourite::getFavouriteArray();
    return json_encode($favourite,true);
  }

  public function actionGet($param)
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $favourite = Favourite::getFavouriteArray($param);
    return json_encode($favourite,true);
  }

  public function actionClear($param)
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    return Favourite::clearFavourite($param);
  }

  public function actionSet($param)
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    return Favourite::setFavourite($param);
  }

  protected function findCartModel($id)
  {
    if (($model = Pages::find()->where(['id' => $id])->one()) !== null) {
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

?>
