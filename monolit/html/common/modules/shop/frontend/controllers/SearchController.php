<?php

namespace common\modules\shop\frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Pages;
use common\modules\shop\common\models\Search;

setlocale(LC_ALL, 'ru_RU.UTF-8');

class SearchController extends Controller
{
  public function actionSearch($id)
  {
    $model = $this->findSearchModel($id);
    $this->registerSearchMeta($model);

    $query = \yii::$app->request->get('q');

    $products = Search::getResults($query);

    return $this->render('search', [
      'model' => $model,
      'products' => $products,
      'query' => $query,
    ]);
  }

  public function actionGetResults()
  {

    $post = json_decode(file_get_contents("php://input"),true);

    if($post) {
      $data = null;
      $data = Search::getResults($post['key']);

      return json_encode($data, true);
    }else{
      return null;
    }
  }

  public function beforeAction($action)
  {
    if($this->action->id == "get-results") {
      $this->enableCsrfValidation = false;
    }

    return parent::beforeAction($action);
  }

  protected function findSearchModel($id)
  {
    if (($model = Pages::find()->where(['id' => $id])->one()) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(t('Страница не найдена'));
    }
  }

  protected function registerSearchMeta($model)
  {
    $view = Yii::$app->view;

    $view->title = $model->title;
    $view->registerMetaTag(['name' => 'description', 'content' => '$description']);
  }
}

?>
