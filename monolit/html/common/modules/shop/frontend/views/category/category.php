<section class="section--content section--collection">
  <div class="wrap">
    <div class="grid-row-inner collection-pad">
      <shop-filter :category="<?= $id ?>"></shop-filter>
      <div class="collection lg-grid-9 sm-grid-12 padded-inner-sides md-padded-sides xs-padded-zero">
        <div class="breadcrumbs lg-fl md-fl">
          <?=$breadcrumbs?>
        </div>
        <h1 class="collection-title content-title">Диваны</h1>
        <category-list :category="<?= $id ?>"></category-list>
        <shop-sort></shop-sort>
        <div class="collection-products_list grid-row">
          <products-list ref="product_list" :category="<?= $id ?>"></products-list>
        </div>
      </div>
    </div>
  </div>
</section>
