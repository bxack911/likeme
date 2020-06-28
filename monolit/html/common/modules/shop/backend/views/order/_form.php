<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;

$order = $model->initialize($model->id);

?>

<?php $form = ActiveForm::begin(['id' => 'form', 'type' => ActiveForm::TYPE_HORIZONTAL]); ?>

<div>
  <div>
    <div class="col-lg-8">
      <h3>Настройки заказа <?= ($model->id) ? $model->id : '' ?></h3>
      <div>
        <ul class="nav nav-tabs" id="contentTabs" role="tablist">
          <li class="nav-item active">
            <a href="#content" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">Контент</a>
          </li>
        </ul>
        <div class="tab-content" id="contentTabsContent">
          <div class="tab-pane fade active in" id="content" role="tabpanel" aria-labelledby="content-tab">
            <h3>Контент</h3>
            <div class="tab-content">
              <?= $form->field($model,'fio')->textInput() ?>
              <?= $form->field($model,'email')->textInput() ?>
              <?= $form->field($model,'sum')->textInput() ?>
              <?= $form->field($model,'phone')->textInput() ?>
              <?= $form->field($model,'comment')->textarea() ?>
              <?= $form->field($model,'delivery_id')->dropDownList(ArrayHelper::map($order['deliveries'],'id', 'name')) ?>
              <?= $form->field($model,'paysystem_id')->dropDownList(ArrayHelper::map($order['paysystems'],'id', 'name')) ?>
              <?= $form->field($model,'date')->textInput() ?>
            </div>
          </div>
        </div>
      </div>

      <div class="card bg-white m-b">
        <div class="card-header">Корзина</div>
        <div class="card-block p-a-0">
          <div class="table-responsive">
            <div class="grid-view">
              <table class="table m-b-0">
                <thead>
                <tr>
                  <td>Наименование</td>
                  <td>Цена товара</td>
                  <td>Количество</td>
                  <td>Стоимость</td>
                </tr>
                </thead>
                <tbody>
                  <?php foreach($order['cart'] as $cart_item): ?>
                    <tr>
                      <td><?= $cart_item->getProduct($cart_item->product_id)->title ?></td>
                      <td><?= $cart_item->getProduct($cart_item->product_id)->price?> грн.</td>
                      <td><?= $cart_item->quantity ?></td>
                      <td><?= $cart_item->sum ?> грн.</td>
                    </tr>
                  <?php endforeach ?>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="pull-right"><p><strong>Итого:</strong></p><?= $order['full_cart_sum'] ?> грн.</td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div>
        <div class="pull-left">
          <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<?php ActiveForm::end(); ?>
