<div class='co-section--content_wrapper'>

  <div class='co-section--content'>
    <div class='co-section--checkout_header co-checkout-block--padded'>

      <h1 class='co-checkout-title co-title co-title--h1'>Спасибо! Ваш заказ № <?= $order->id ?></h1>
    </div>

    <div class='co-section--content'>
      <div class='co-checkout-block--padded'>
        <div class='co-title co-title--h2'>Информация о заказе</div>
        <div class='co-order-information'>
          <div class='co-order-information_row'>
            <div class='co-order-information_title'>Дата оформления</div>
            <div class='co-order-information_value'><?= date('Y-m-d h-m', $order->date) ?></div>
          </div>
          <div class='co-order-information_row'>
            <div class='co-order-information_title'>Сумма и статус</div>
            <div class='co-order-information_value'>
              <span class='co-price'><?= $order->sum ?> грн.</span>
              <span class='co-order-state'>Принят</span>
              <span class='co-order-state co-order-state--not_paid'>Не оплачен</span>
            </div>
          </div>
          <div class='co-order-information_row'>
            <div class='co-order-information_title'>Способ оплаты</div>
            <div class='co-order-information_value'><?= $model['paysystem']->name ?></div>
          </div>

          <div class='co-order-information_row'>
            <div class='co-order-information_title'>Способ доставки</div>
            <div class='co-order-information_value'><?= $model['paysystem']->name ?> (<?= $model['paysystem']->comment ?>)</div>
          </div>

          <div class='co-order-information_row'>
            <div class='co-order-information_title'>Адрес доставки</div>
            <div class='co-order-information_value'>Новий Кременчуг , Криворізький район, обл. Дніпропетровська</div>
          </div>

          <div class='co-order-information_row'>
            <div class='co-order-information_title'>Получатель</div>
            <div class='co-order-information_value'><?= $model['order']->fio ?> <?= $model['order']->phone ?></div>
          </div>

        </div>
        <div class='co-title co-title--h2'>Состав заказа</div>
        <table class='co-table co-table--to_card'>
          <tr class='co-table-row co-table-row--head'>
            <td class='co-table-cell co-table-cell--head'>Наименование</td>
            <td class='co-table-cell co-table-cell--head'>Кол-во</td>
            <td class='co-table-cell co-table-cell--head'>Стоимость</td>
          </tr>
          <?php foreach($model['cart']->products as $product): ?>
            <tr class='co-table-row co-table-row--body co-table-row--striped'>
              <td class='co-table-cell co-table-cell--body' data-title='Наименование'><?= $product->title ?></td>
              <td class='co-table-cell co-table-cell--body' data-title='Кол-во'><?= $product->quantity ?></td>
              <td class='co-table-cell co-table-cell--body' data-title='Стоимость'><?= $product->sum ?> грн.</td>
            </tr>
          <?php endforeach ?>

          <tr class='co-table-row co-table-row--foot'>
            <td class='co-table-cell co-table-cell--foot' colspan='3'>
              <div class='co-order_history-total_title'>Итого:</div>
              <div class='co-order_history-total_sum co-price'><?= $model['cart']->cart[0]->sum ?> грн.</div>
            </td>
          </tr>
        </table>
      </div>
    </div>

  </div>
</div>
