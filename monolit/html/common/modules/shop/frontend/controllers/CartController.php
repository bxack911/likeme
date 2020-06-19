<?php

namespace common\modules\shop\frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Pages;
use common\modules\shop\common\models\Cart;
use common\modules\shop\common\models\Category;

setlocale(LC_ALL, 'ru_RU.UTF-8');

class CartController extends Controller
{
  public function actionCartPage($id)
  {
    $cart = $this->findCartModel($id);
    $this->registerPagesMeta($cart);

    return $this->render('cart');
  }

  public function actionCartung()
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $cart = Cart::getCartArray();
    return $cart;
  }

  public function actionIncrease($param)
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $cart = Cart::increase($param);
    return $cart;
  }

  public function actionDecrease($param)
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $cart = Cart::decrease($param);
    return $cart;
  }

  public function actionSum($param,$quantity)
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    $cart = Cart::summ($param,$quantity);
    return $cart;
  }

  public function actionQuantity($param)
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    return Cart::getQuantity($param);
  }

  public function actionClear($param)
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    return Cart::clearCart($param);
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
