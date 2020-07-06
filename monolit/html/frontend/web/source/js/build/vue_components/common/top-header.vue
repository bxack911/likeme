<template>
  <div v-if="showing" class="section--right lg-grid-4 mc-grid-6 relative">
      <span class="search_widget-toggler fr js-search_widget-toggler">
           <img src="/storage/icons/search_icon.svg" :title="this.getTranslation('Search')" :alt="this.getTranslation('Search')">
      </span>

      <div class="hidden mc-hidden js-search_widget-wrapper">
        <search-form></search-form>
      </div>

      <div class="basket block_compare_header">
        <a href="/compares" class="basket-link" :title="this.getTranslation('Compare')">
          <span class="basket-icon">
            <img class="header_wirl_fav" src="/storage/icons/repeat.svg" :title="this.getTranslation('Compare')" :alt="this.getTranslation('Compare')">
          </span>
          <span class="basket-total">
            <span class="basket-items_count" data-compare-counter></span>
          </span>
        </a>
      </div>

      <div class="basket block_favorite_header">
        <a href="/page/favorite" class="basket-link" :title="this.getTranslation('Favourites')">
          <span class="basket-icon">
            <img src="/storage/icons/wirl_fav.svg" class="header_wirl_fav" :title="this.getTranslation('Favourites')" :alt="this.getTranslation('Favourites')">
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
    data() {
      return {
        showing: false,
        translations: [],
      }
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
      getTranslations: function() {
        axios.get(this.$microservices_url + this.$micro_others_port + '/get-translations').then((response) => {
          this.translations = response.data;
          this.showing = true;
        });
      },
      getTranslation: function(key) {
        return JSON.parse(this.translations[key].value)[this.$language];
      },
    },
    created() {
      this.search_init();
      this.getTranslations();
    }
  }
</script>
