<template>
  <div class="lg-grid-4 sm-grid-6 mc-grid-6 padded-sides">
    <div class="product_preview product_preview--product_list">
      <button type="button" class="block_wirl_fav is-added" v-if="product.favourite == 'true'" v-on:click="setFavourite">
        <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/wirl_fav.svg" class="wirl_fav" v-on:click="">
        <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/wirl_fav_hover.svg"
             class="wirl_fav_hover">
      </button>
      <button type="button" class="block_wirl_fav not-added" v-if="product.favourite == 'false'" v-on:click="setFavourite">
        <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/wirl_fav.svg" class="wirl_fav">
        <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/wirl_fav_hover.svg"
             class="wirl_fav_hover">
      </button>
      <div class="product_preview-preview">
        <div class="product_preview-tips">
          <div class="product_preview-tip product_preview-tip--new" v-if="product.is_new">Новинка</div>
          <div class="product_preview-tip product_preview-tip--disc" v-if="product.discount != '0'">-{{ product.discount }}</div>
        </div>
        <a :href="product.link" class="product_preview-image" :title="product.title">
          <picture><img :src="product.image" class="col-img image1" :alt="product.title" title="product.title"/></picture>
          <div class="col-cover col-cover2">
            <picture><img :src="product.image2" class="col-img image2" alt="Диван Textile Yellow" title="Диван Textile Yellow"/></picture>
          </div>
        </a>
      </div>
      <div class="product_preview-title">
        <a :href="product.link" class="product_preview-link" title="Диван Textile Yellow">{{ product.title }}</a>
      </div>
      <div class="product_preview-prices prices" v-if="product.discount != 0">
        <span class="prices-old">{{ product.price }} грн.</span>
        <span class="prices-current">{{ product.discount_sum }} грн.</span>
      </div>
      <div class="product_preview-prices prices" v-if="product.discount == 0">
        <span class="prices-current">{{ product.price }} грн.</span>
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
        favourite: false,
      }
    },
    methods: {
      setFavourite() {
        axios.get("/shop/favourite/set/" + this.product.id).then((response) => {
          this.favourite = response.data;
        });
      },
    },
  }
</script>
