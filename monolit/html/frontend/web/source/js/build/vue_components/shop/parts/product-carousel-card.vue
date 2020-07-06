<template>
  <div v-if="showing">
    <button type="button" class="block_wirl_fav">
      <img src="/storage/icons/wirl_fav.svg" class="wirl_fav">
      <img src="/storage/icons/wirl_fav_hover.svg" class="wirl_fav_hover">
    </button>
    <div class="product_preview-preview">
      <div class="product_preview-tips">
        <div class="product_preview-tip product_preview-tip--new" v-if="product.is_new">{{ getTranslation('New') }}</div>
        <div class="product_preview-tip product_preview-tip--disc" v-if="product.discount != 0">-{{ product.discount }}</div>
      </div>

      <a :href="product.link" class="product_preview-image" :title="product.title">
        <picture><img :src="product.image" class="col-img image1" :alt="product.title" title="product.title"/></picture>
        <div class="col-cover col-cover2">
          <picture><img :src="product.image2" class="col-img image2" alt="Диван Textile Yellow" :title="product.title" /></picture>
        </div>
      </a>
    </div>

    <div class="product_preview-title">
      <a :href="product.link" class="product_preview-link" :title="product.title">{{ product.title }}</a>
    </div>
    <div class="product_preview-prices prices" v-if="product.discount != 0">
      <span class="prices-old">{{ product.discount_sum }} {{ getTranslation('grn') }}.</span>
      <span class="prices-current">{{ product.price }} {{ getTranslation('grn') }.</span>
    </div>
  </div>
</template>

<script>
  import axios from "axios";

  export default {
    name: 'product-carousel-card',
    data() {
      return {
        showing: false,
        translations: [],
      }
    },
    props: ['product'],
    methods: {
      getTranslations: function () {
        axios.get(this.$microservices_url + this.$micro_others_port + '/get-translations').then((response) => {
          this.translations = response.data;
          this.showing = true;
        });
      },
      getTranslation: function (key) {
        return JSON.parse(this.translations[key].value)[this.$language];
      }
    },
    created() {
      this.search_init();
      this.getTranslations();
    }
  }
</script>
