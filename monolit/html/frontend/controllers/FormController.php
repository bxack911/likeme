<?php

namespace frontend\controllers;

use yii\helpers\Url;
use yii\web\Controller;

setlocale(LC_ALL, 'ru_RU.UTF-8');

class FormController extends Controller
{
  public function actionSend($model)
  {
    $formModel = $this->setFormData($model);
    return (!$formModel) ? $formModel : \yii::$container->get("\\frontend\models\\" . $formModel['model'])->set($formModel['id']);
  }

  private function setFormData($model)
  {
    if ($post = \yii::$app->request->post()) {
      if (!isset($post['_model'])) return false;

      $data = $post[$post['_model']];
      $order = \yii::$container->get($model);

      foreach ($data as $attr => $value) {
        $order->{$attr} = $value;
      }

      if ($order->validate()) {
        if ($order->save()) {
          if ($order->email) {
            $labels = $order->attributeLabels();
            $msg = "";
            foreach ($data as $attr => $value) {
              $msg .= $labels[$attr] . ": " . $value . PHP_EOL;
              $order->{$attr} = $value;
            }

            /*\yii::$app->mailer->compose()
              ->setTo($data['email'])
              ->setFrom("noreply@" . \yii::$app->request->serverName)
              ->setSubject($model->subject)
              ->setTextBody($msg)
              ->send();*/
            return [
              'id' => $order->id,
              'model' => $post['_model']
            ];
          }else{
            $labels = $order->attributeLabels();
            $msg = "";
            foreach ($data as $attr => $value) {
              $msg .= $labels[$attr] . ": " . $value . PHP_EOL;
              $order->{$attr} = $value;
            }
            /*\yii::$app->mailer->compose()
              ->setTo(\yii::$app->adminEmail)
              ->setFrom("noreply@" . \yii::$app->request->serverName)
              ->setSubject($model->subject)
              ->setTextBody($msg)
              ->send();*/
          }
          return [
            'id' => $order->id,
            'model' => $post['_model']
          ];
        }
      }
    }
    return false;
  }
}
