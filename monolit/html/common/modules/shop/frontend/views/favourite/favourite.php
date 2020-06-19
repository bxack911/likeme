<sectin class="section--content">
  <div class="co-section--checkout_content">
    <div class="co-section--checkout_order co-section--checkout_order_sided">
      <div class="co-section--checkout_header co-checkout-block--padded">
        <h1 class="co-checkout-title co-title co-title--h1"><?= $favourite->title ?></h1>
        <?=$breadcrumbs?>
      </div>
      <div class="collection-products_list grid-row">
        <products-list ref="product_list" :category="'favourite'"></products-list>
      </div>
    </div>
  </div>
</sectin>
