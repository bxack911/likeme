<section class="section--content section--search">
  <div class="wrap">
    <h1 class="search-title content-title">Поиск</h1>

    <div class="search-block">
      <div class="row padded-inner-bottom sm-center xs-center">
        <?php if($products): ?>
          <span class="search-help">Вы искали</span>
        <?php else: ?>
            <span class="search-help">Измените ключевые слова для поиска</span>
        <?php endif ?>
        <form action="/search" method="get" class="search_widget search_widget--search">
          <input type="text" name="q" value="<?= $query ?>" placeholder="Поиск" class="search_widget-field"/>
          <button type="submit" class="search_widget-submit button--border">
            <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/search_icon.svg">
          </button>
        </form>
      </div>
      <?php if($products): ?>
        <?php foreach($products as $product): ?>
          <product-card :product='<?= json_encode($product, true) ?>'></product-card>
        <?php endforeach ?>
      <?php else: ?>
        <div class="search-notice notice notice--warning">
          По запросу "<?= $query ?>" ничего не найдено.
        </div>
      <?php endif ?>
    </div>

  </div>


</section>
