<template>
  <div class="basket" v-if="showing">
    <a href="/cart" class="basket-link">
      <span class="basket-icon">
        <span class="basket-title"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
      </span>
      <span class="basket-total">
        <span class="basket-items_count js-basket-items_count" v-if="cart != 0">{{ cart.product_quantity }}</span>
        <span class="basket-items_count js-basket-items_count" v-if="cart == 0">0</span>
      </span>
    </a>

    <div class="basket-dropdown basket_list sm-hidden xs-hidden padded-inner">
      <div class="basket_list-header">
        <span class="basket_list-title">{{ getTranslation('Basket') }} <span v-if="cart != 0">(товаров {{ cart.product_quantity }})</span></span>
        <div class="notice" v-if="cart == 0">
          {{ empty_cartung_text }}
        </div>
        <div v-if="cart != undefined">
          <ol class="basket_list-items">
            <li class="basket_item grid-row" v-for="product in products">
              <a href="/" class="basket_item-image lg-grid-3 padded-sides">
                <img :src="product.image" alt="">
              </a>
              <div class="lg-grid-8 padded-sides">
                <a href="/" class="basket_item-title">{{ product.title }}</a>
                <div class="basket_item-details right">
                  <span class="basket_item-count">{{ product.quantity }} x</span>
                  <span class="basket_item-price prices">
                    <span class="prices-current">{{ product.sum }} {{ getTranslation('grn') }}.</span>
                  </span>
                </div>
              </div>
              <a class="lg-grid-1 basket_item-delete js-cart_item-delete" title="Удалить из корзины"v-on:click="clear_cart(product.id)">
                <img src="/storage/icons/cross_icon.svg" alt="">
              </a>
            </li>
          </ol>
          <div class="basket_list-footer" v-if="cart != 0">
            <div class="basket_list-total right">
              <span class="basket_list-span">{{ getTranslation("header_cartung_sum") }}:</span>
              <div class="basket_list-price prices-current">{{ cart.sum }} {{ getTranslation('grn') }}.</div>
            </div>
            <div class="basket_list-buttons">
              <a href="/cart" class="basket_list-submit button button--border">{{ getTranslation('View cartung') }}</a>
              <a href="/order" class="basket_list-submit button button--buy">{{ getTranslation('Checkout') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import Vue from "vue";

  export default {
    name: 'header-cartung',
    data() {
      return {
        quantity: 0,
        cart: [],
        showing: false,
        products: [],
        translations: [],
      }
    },
    methods: {
      get_cart() {
        axios.get(this.$microservices_url + this.$micro_products_port + '/get-cartung/1/ru').then((response) => {
          var data = response.data;

          if(data[0] != undefined && data[1] != undefined){
            this.products = new Array(data[0].length);
            this.products = data[0];
            this.cart = data[1][1];
          }else{
            this.products = 0;
            this.cart = 0;
          }
        }).catch((err) => {
          console.log(err);
        });
      },
      clear_cart(id) {
        axios.get(this.$microservices_url + this.$micro_products_port + '/delete-cart/1/'+id+'/ru').then((response) => {
          this.reload();
        }).catch((err) => {
          console.log(err);
        });
      },
      reload() {
        this.get_cart();
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
      this.get_cart();
      this.getTranslations();
    }
  }
</script>
