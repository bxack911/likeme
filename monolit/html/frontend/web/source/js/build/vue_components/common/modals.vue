<template>
  <div class="modals_container" v-if="showing">
    <div class="modal modal--product_added center">
      <div class="modal-wrapper">
        <div class="modal-header">{{ getTranslation('Product added to cart') }}</div>
        <span class="button button--borderjs-modal-close" v-on:click="hide">{{ getTranslation('Continue Shopping') }}</span>
        <a href="/shop/cart/page" class="button button--buy">{{ getTranslation('Go to cart') }}</a>
      </div>
    </div>
    <div class="overlay" v-on:click="hide"></div>
  </div>
</template>

<script>
  import axios from "axios";

  export default {
    name: 'modals',
    data() {
      return {
        key: '',
        showing: false,
        translations: [],
        search_results: [],
        search_on: false,
      }
    },
    methods: {
      hide() {
        document.querySelector('.modal--product_added').setAttribute("style", 'display: none');
        document.querySelector('.overlay').setAttribute("style", 'display: none');
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
      this.getTranslations();
    }
  }
</script>
