<template>
  <div class="section--right lg-grid-4 mc-grid-6 relative">
      <span class="search_widget-toggler fr js-search_widget-toggler">
           <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/search_icon.svg" title="Поиск" alt="Поиск">
      </span>

      <div class="hidden mc-hidden js-search_widget-wrapper">
        <search-form></search-form>
      </div>

      <div class="basket block_compare_header">
        <a href="/compares" class="basket-link" title="Сравнение">
          <span class="basket-icon">
            <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/repeat.svg" class="header_wirl_fav" title="Сравнение" alt="Сравнение">
          </span>
          <span class="basket-total">
            <span class="basket-items_count" data-compare-counter></span>
          </span>
        </a>
      </div>

      <div class="basket block_favorite_header">
        <a href="/page/favorite" class="basket-link" title="Избранное">
          <span class="basket-icon">
            <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/wirl_fav.svg" class="header_wirl_fav" title="Избранное" alt="Избранное">
          </span>
          <span class="basket-total">
            <span class="basket-items_count" data-favorites-counter></span>
          </span>
        </a>
      </div>

      <div class="fr sm-hidden basket-wrapper">
        <header-cartung ref="header_cart"></header-cartung>
      </div>
    </div>
</template>

<script>
  import axios from 'axios';
  import headerCartung from './parts/header-cartung';
  import searchForm from './parts/search_form';

  export default {
    name: "top-header",
    components: {
      headerCartung: headerCartung,
      searchForm: searchForm,
    },
    methods: {
      search_init() {
        $(document).on('click', ".search_widget-toggler", function () {
          $(".js-search_widget-wrapper").toggleClass('hidden');
          $(".js-search_widget-wrapper").toggleClass('mc-hidden');
        });
      },
      reload_basket() {
        this.$refs.header_cart.reload();
      },
    },
    created() {
      this.search_init();
    }
  }
</script>
