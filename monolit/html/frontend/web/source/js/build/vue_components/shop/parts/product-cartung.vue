<template>
  <div v-if="showing">
    <div class="product-control">
      <div class="product-quantity quantity quantity--side" data-quantity>
        <div class="quantity-button quantity-button--minus button js-quantity-minus" v-on:click="decrease">-</div>
        <input type="text" id="product_quantity" v-on:keyup="sum" :value="quantity" class="quantity-input js-quantity-input" />
        <div class="quantity-button quantity-button--plus button js-quantity-plus" v-on:click="increase">+</div>
      </div>
      <button class="product-buy button  js-buy" v-on:click="add">
        {{ getTranslation('To cart') }}
      </button>
      <button class="product-buy button quick_btn" data-quick-checkout>
        {{ getTranslation('1 click order') }}
      </button>
      <button type="button" class="block_wirl_fav" data-favorites-trigger="155454002">
        <img src="/storage/icons/wirl_fav.svg" class="wirl_fav">
        <img src="/storage/icons/wirl_fav_hover.svg" class="wirl_fav_hover">
      </button>
    </div>
    <div class="product-compare compare-trigger lg-grid-12">
            <span class="compare-add
                        js-compare-add"
                  data-product_id="155454002">
              <i class="fa fa-bar-chart"></i>
              <span class="compare-trigger_text">{{ getTranslation(' add to comparison') }}</span>
            </span>

      <a href="/compares/"
         class="compare-added">
        <i class="fa fa-check"></i>
        <span class="compare-trigger_text">{{ getTranslation('go to comparison') }}</span>
      </a>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import headerCart from '../../common/parts/header-cartung';

  export default {
    name: 'product-cartung',
    props: ['product'],
    data() {
      return {
        quantity: 1,
        showing: false,
        translations: [],
      }
    },
    components: {
      headerCart: headerCart,
    },
    methods: {
      decrease() {
        if(this.quantity > 1)
          this.quantity--;
      },
      increase() {
        this.quantity++;
      },
      sum() {
        this.quantity = document.querySelector('#product_quantity').value;
      },
      add() {
        this.quantity = document.querySelector('#product_quantity').value;

        axios.get(this.$microservices_url + this.$micro_products_port + '/get-cart/1/'+this.product+'/ru/sum/' + this.quantity).then((response) => {
          document.querySelector('.modal--product_added').setAttribute("style", 'display: block');
          document.querySelector('.overlay').setAttribute("style", 'display: block');
          this.$root.reloadCartung();
        });
      },
      reload_basket() {
        this.quantity = 1;
      },
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
    mounted() {
      this.getTranslations();
      axios.get(this.$microservices_url + this.$micro_products_port + '/get-quantity/1/' + this.product).then((response) => {
        if(response.data !== null) this.quantity = response.data;
      }).catch((err) => {
        this.quantity = 1;
      });
    }
  }
</script>
