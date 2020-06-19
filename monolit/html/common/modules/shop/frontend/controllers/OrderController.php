<?php

namespace common\modules\shop\frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Pages;
use common\helpers\BreadcrumbsHelper;
use common\modules\shop\common\models\Order;
setlocale(LC_ALL, 'ru_RU.UTF-8');

class OrderController extends Controller
{

  public function actionView($id)
  {
    $order = $this->findOrderModel($id);
    $this->registerOrderMeta($order);

    $model = Order::initialize();

    return $this->render('order',[
      'breadcrumbs' => BreadcrumbsHelper::get($order->breadcrumbs),
      'modelObj' => new Order(),
      'model' => $model,
      'orderForm' => $model['orderForm'],
      'order' => $order
    ]);
  }

  public function actionResult($id)
  {
    $order = $this->findOrderModel($id);
    $this->registerOrderMeta($order);

    $model = Order::getOrder(\yii::$app->request->get('order'));

    if(!$model['order']) throw new NotFoundHttpException(t('Страница не найдена'));

    return $this->render('result',[
      'breadcrumbs' => BreadcrumbsHelper::get($order->breadcrumbs),
      'order' => $model['order'],
      'model' => $model
    ]);
  }

  protected function findOrderModel($id)
  {
    if (($model = Pages::findActive($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(t('Страница не найдена'));
    }
  }

  protected function registerOrderMeta($model)
  {
    $view = Yii::$app->view;

    $view->title = $model->title;
    $view->registerMetaTag(['name' => 'description', 'content' => '$description']);
  }
}
