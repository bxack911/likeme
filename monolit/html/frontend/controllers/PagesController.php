<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Pages;
use common\models\Blocks;
use common\models\search\Pages as PagesSearch;
use yii\elasticsearch\ClientBuilder;

setlocale(LC_ALL, 'ru_RU.UTF-8');

class PagesController extends Controller
{

  /**
   * Displays default material page.
   *
   * @param $id
   * @return mixed
   */
  public function actionView($id)
  {
    $page = $this->findPagesModel($id);
    $this->registerPagesMeta($page);

    return $this->render('view', [
      'page' => $page
    ]);
  }

  /**
   * Displays homepage.
   *
   * @param $id
   * @return mixed
   */

  public function actionHome($id)
  {
    /*$array = [];
    for($i = 0; $i < 40; $i++){
        array_push($array, Yii::$app->redis->get('key-' . $u));
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }*/

    /*$pages = new PagesSearch([
        'page_id' => 1,
        'status' => 1,
        'slug' => 'index'
    ]);

    
    $pages->indexatorr();

    Yii::$app->logstash->sendLog([
        'event' => 'Visit homepage',
        'route' => Url::to('pages/home'),
        'username' => 'Budulay',
        'ip' => $_SERVER['REMOTE_ADDR']
    ]);*/

    $page = $this->findPagesModel($id);
    $this->registerPagesMeta($page);
    return $this->render('home', [
      'page' => $page,
    ]);
  }

  protected function findPagesModel($id)
  {
    if (($model = Pages::findActive($id)) !== null) {
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
