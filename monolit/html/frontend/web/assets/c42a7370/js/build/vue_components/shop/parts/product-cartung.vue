<template>
  <div>
    <div class="product-control">
      <div class="product-quantity quantity quantity--side" data-quantity>
        <div class="quantity-button quantity-button--minus button js-quantity-minus" v-on:click="decrease">-</div>
        <input type="text" id="product_quantity" v-on:keyup="sum" :value="quantity" class="quantity-input js-quantity-input" />
        <div class="quantity-button quantity-button--plus button js-quantity-plus" v-on:click="increase">+</div>
      </div>
      <button class="product-buy button  js-buy" v-on:click="add">
        В корзину
      </button>
      <button class="product-buy button quick_btn" data-quick-checkout>
        Заказ в 1 клик
      </button>
      <button type="button" class="block_wirl_fav" data-favorites-trigger="155454002">
        <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/wirl_fav.svg" class="wirl_fav">
        <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/wirl_fav_hover.svg" class="wirl_fav_hover">
      </button>
    </div>
    <div class="product-compare compare-trigger lg-grid-12">
            <span class="compare-add
                        js-compare-add"
                  data-product_id="155454002">
              <i class="fa fa-bar-chart"></i>
              <span class="compare-trigger_text">добавить к сравнению</span>
            </span>

      <a href="/compares/"
         class="compare-added">
        <i class="fa fa-check"></i>
        <span class="compare-trigger_text">перейти к сравнению</span>
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

        axios.get('http://172.17.0.3:30101/get-cart/1/'+this.product+'/ru/sum/' + this.quantity).then((response) => {
          document.querySelector('.modal--product_added').setAttribute("style", 'display: block');
          document.querySelector('.overlay').setAttribute("style", 'display: block');
          this.$root.reloadCartung();
        });
      },
      reload_basket() {
        this.quantity = 1;
      }
    },
    mounted() {
      axios.get('/shop/cart/quantity/' + this.product).then((response) => {
        if(response.data !== null) this.quantity = response.data;
      });
    }
  }
</script>
