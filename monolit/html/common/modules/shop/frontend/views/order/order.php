<?php
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
?>

<sectin class="section--content">
  <div class="co-section--checkout_content">
    <div class="co-section--checkout_order co-section--checkout_order_sided">
      <div class="co-section--checkout_header co-checkout-block--padded">
        <h1 class="co-checkout-title co-title co-title--h1"><?= $order->title ?></h1>
        <?=$breadcrumbs?>
      </div>
      <div class="co-sidebar-wrapper">
        <button class="co-sidebar-toggler js-co-sidebar-toggler">
          <span>
            <span class="co-icon halfling-shopping-cart"><i class="fa fa-shopping-cart"></i></span>
            <span class="co-sidebar-toggler_title">Ваш заказ</span>
            <span class="co-icon halfling-menu-down"><i class="fa fa-chevron-down"></i></span>
          </span>
          <span class="co-basket_total-price co-price--current"><?= $model['cart'][1]['sum'] ?> грн.</span>
        </button>
        <div class="co-sidebar js-co-sidebar co-sidebar--fixed co-sidebar--hidden@sm">
          <div class="co-basket co-checkout-block--padded">
            <?php if($model['cart']): ?>
            <div class="co-basket_item-list">

              <?php foreach($model['cart'] as $product): ?>
                <div class="co-basket_item">
                  <div class="co-basket_item-image"><img src="<?= $product['image'] ?>" alt="image"></div>
                  <div class="co-basket_item-description"><?= $product['title'] ?></div>
                  <div class="co-basket_item-total">
                    <span class="co-basket_item-count"><?= $product['quantity'] ?></span> x <span class="co-basket_item-price co-price--current"><?= $product['sum'] ?> грн.</span>
                  </div>
                </div>
              <?php endforeach ?>

            </div>
            <?php endif; ?>
            <div class="co-basket_subtotal-list">
              <div class="co-basket_subtotal">
                <div class="co-basket_subtotal-title">Сумма по товарам</div>
                <div class="co-basket_subtotal-price co-price--current"><?= $model['cart'][1]['sum'] ?> грн.</div>
              </div>
              <div id="discounts-block"></div>
              <div class="co-basket_subtotal">
                <div class="co-basket_subtotal-title">Стоимость доставки</div>
                <div class="co-basket_subtotal-price co-price--current" id="delivery_price">0 руб</div>
              </div>
            </div>
            <div class="co-basket_total">
              <div class="co-basket_total-title">Итого:</div>
              <div class="co-basket_total-price co-price--current" id="total_price"><?= $model['cart'][1]['sum'] ?> грн.</div>
            </div>
          </div>
        </div>
      </div>
      <?php $form = ActiveForm::begin(['id' => 'OrderForm','action' => '/form/send/' . $modelObj->formName(), 'options' => [
        'class' => 'co-checkout-order_form co-checkout-block--padded'
      ]]); ?>
        <input type="hidden" name="_model" value="<?= $orderForm->model ?>" />
        <?= $form->field($orderForm, 'date')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false) ?>
        <?= $form->field($orderForm, 'sum')->hiddenInput(['value' => $model['cart'][1]['sum']])->label(false) ?>
        <div class="co-delivery_method-list co-checkout-block">

          <div class="co-checkout-block">
            <div class="co-input co-input--required co-input--tel">
              <h2 class="co-input-label co-title co-title--h2"><?= $model['labels']['phone'] ?></h2>
              <?= $form->field($orderForm, 'phone')->widget(MaskedInput::className(), [
                'options' => [
                  'class' => 'co-input-field js-input-field',
                  'placeholder' => '+38 (099) 999 99 99'
                ],
                'mask' => '+38 (099) 999 99 99'
                ])->label(false) ?>
            </div>
          </div>

          <div class="variants delivery_variants co-input co-input--required co-input--radio co-tabs">
            <div class="co-tabs-content co-tabs-content--active">
              <?php foreach ($model['deliveries'] as $index => $delivery): ?>
                <label class="co-delivery_method co-input-wrapper co-toggable_field co-toggable_field--bordered">
                  <span class="radio co-delivery_method-input co-toggable_field-input co-toggable_field-input--radio">
                    <input <?= ($index == 0) ? 'checked' : '' ?> name="<?= $orderForm->formName() ?>[delivery_id]" type="radio" class="radio_button js-input-field" value="<?= $delivery->id ?>" />
                    <span></span>
                  </span>
                  <span class="co-toggable_field-information co-delivery_method-information">
                    <span class="co-delivery_method-title co-toggable_field-title co-input-title">Самовывоз в магазине</span>
                    <span class="co-delivery_method-description co-toggable_field-description co-input-description"><p>Забрать заказ абсолютно БЕСПЛАТНО можно в нашем фирменном магазине.</p></span>
                  </span>
                  <span class="co-delivery_method-price co-toggable_field-price co-price--current">+ 50 грн.</span>
                </label>
              <?php endforeach ?>
            </div>
          </div>

          <div class="co-checkout-block">
            <div class="co-input co-input--textarea co-input--comment co-input--nested co-input--empty_nested">
              <label class="co-input-label">
                <label for="order_comment"><?= $model['labels']['comment'] ?></label>
              </label>
              <?= $form->field($orderForm, 'comment')->textarea([
                'class' => 'co-input-field js-input-field',
                'rows' => 2
              ])->label(false) ?>
            </div>
          </div>

          <div class="co-customer co-checkout-block co-tabs">
            <h3 class="co-title co-title--h2 co-tabs-header">Покупатель</h3>
            <div class="co-tabs-content  co-tabs-content--active">
              <div class="co-input co-input--required co-input--text co-input--name  co-input--nested co-input--empty_nested co-checkout-block">
                <label class="co-input-label"><?= $model['labels']['fio'] ?></label>
                <?= $form->field($orderForm, 'fio')->textInput(['class' => 'co-input-field js-input-field form-control'])->label(false) ?>
              </div>

              <div class="co-input co-input--required co-input--text co-input--name  co-input--nested co-input--empty_nested co-checkout-block">
                <label class="co-input-label"><?= $model['labels']['email'] ?></label>
                <?= $form->field($orderForm, 'email')->textInput(['class' => 'co-input-field js-input-field'])->label(false) ?>
              </div>
            </div>
          </div>

          <div class="variants delivery_variants co-input co-input--required co-input--radio co-tabs">
            <h3 class="co-title co-title--h2 co-input-label">Способ оплаты</h3>
            <?php foreach ($model['paysystems'] as $index => $paysystem): ?>
              <div class="co-tabs-content co-tabs-content--active">
                <label class="co-delivery_method co-input-wrapper co-toggable_field co-toggable_field--bordered">
                  <span class="radio co-delivery_method-input co-toggable_field-input co-toggable_field-input--radio">
                    <input <?= ($index == 0) ? 'checked' : '' ?> name="<?= $orderForm->formName() ?>[paysystem_id]" type="radio" class="radio_button js-input-field" value="<?= $paysystem->id ?>" />
                    <span></span>
                  </span>
                  <span class="co-toggable_field-information co-delivery_method-information">
                    <span class="co-delivery_method-title co-toggable_field-title co-input-title"><?= $paysystem->name ?></span>
                    <span class="co-delivery_method-description co-toggable_field-description co-input-description"><?= $paysystem->comment ?></span>
                  </span>
                </label>
              </div>
            <?php endforeach ?>
          </div>

        </div>
      <button class="button button--checkout js-cart-submit" type="submit">Подтвердить заказ</button>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</sectin>

<?php ActiveForm::begin() ?>

<?php ActiveForm::end(); ?>
