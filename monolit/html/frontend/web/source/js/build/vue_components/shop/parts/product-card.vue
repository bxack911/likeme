<template>
  <div v-if="showing" class="lg-grid-4 sm-grid-6 mc-grid-6 padded-sides">
    <div class="product_preview product_preview--product_list">
      <button type="button" class="block_wirl_fav is-added" v-if="product.favourite == 'true'" v-on:click="setFavourite">
        <img src="/storage/icons/wirl_fav.svg" class="wirl_fav" v-on:click="">
        <img src="/storage/icons/wirl_fav_hover.svg"
             class="wirl_fav_hover">
      </button>
      <button type="button" class="block_wirl_fav not-added" v-if="product.favourite == 'false'" v-on:click="setFavourite">
        <img src="/storage/icons/wirl_fav.svg" class="wirl_fav">
        <img src="/storage/icons/wirl_fav_hover.svg"
             class="wirl_fav_hover">
      </button>
      <div class="product_preview-preview">
        <div class="product_preview-tips">
          <div class="product_preview-tip product_preview-tip--new" v-if="product.is_new">{{ getTranslation('New') }}</div>
          <div class="product_preview-tip product_preview-tip--disc" v-if="product.discount != '0'">-{{ product.discount }}</div>
        </div>
        <a :href="product.link" class="product_preview-image" :title="product.title">
          <picture><img :src="product.image" class="col-img image1" :alt="product.title" title="product.title"/></picture>
          <div class="col-cover col-cover2">
            <picture><img :src="product.image2" class="col-img image2" alt="Диван Textile Yellow" :title="product.title"/></picture>
          </div>
        </a>
      </div>
      <div class="product_preview-title">
        <a :href="product.link" class="product_preview-link" :title="product.title">{{ product.title }}</a>
      </div>
      <div class="product_preview-prices prices" v-if="product.discount != 0">
        <span class="prices-old">{{ product.price }} {{ getTranslation('grn') }}.</span>
        <span class="prices-current">{{ product.discount_sum }} {{ getTranslation('grn') }}.</span>
      </div>
      <div class="product_preview-prices prices" v-if="product.discount == 0">
        <span class="prices-current">{{ product.price }} {{ getTranslation('grn') }}.</span>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    name: 'product-card',
    props: ['product'],
    data() {
      return {
        showing: false,
        translations: [],
        favourite: false,
      }
    },
    methods: {
      setFavourite() {
        axios.get("/shop/favourite/set/" + this.product.id).then((response) => {
          this.favourite = response.data;
        });
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
