<template>
  <div class="basket" v-if="showing">
    <a href="/cart" class="basket-link">
      <span class="basket-icon">
        <span class="basket-title"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
      </span>
      <span class="basket-total">
        <span class="basket-items_count js-basket-items_count" v-if="cart[0]">{{ cart[0].product_quantity }}</span>
        <span class="basket-items_count js-basket-items_count" v-if="!cart[0]">0</span>
      </span>
    </a>

    <div class="basket-dropdown basket_list sm-hidden xs-hidden padded-inner">
      <div class="basket_list-header">
        <span class="basket_list-title">Корзина <span v-if="cart[0]">(товаров {{ cart[0].product_quantity }})</span></span>
        <div class="notice" v-if="!cart[0]">
          Корзина пуста. Добавьте интересующий товар в корзину и перейдите к оформлению заказа.
        </div>
        <div v-if="cart[0]">
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
                    <span class="prices-current">{{ product.sum }} грн.</span>
                  </span>
                </div>
              </div>
              <a class="lg-grid-1 basket_item-delete js-cart_item-delete" title="Удалить из корзины"v-on:click="clear_cart(product.id)">
                <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/cross_icon.svg" alt="">
              </a>
            </li>
          </ol>
          <div class="basket_list-footer">
            <div class="basket_list-total right">
              <span class="basket_list-span">Итого без учета доставки:</span>
              <div class="basket_list-price prices-current">{{ cart[0].sum }} грн.</div>
            </div>
            <div class="basket_list-buttons">
              <a href="/cart" class="basket_list-submit button button--border">Просмотреть корзину</a>
              <a href="/cart" class="basket_list-submit button button--buy">Офофрмить заказ</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    name: 'header-cartung',
    data() {
      return {
        quantity: 0,
        cart: [],
        showing: true,
        products: [],
      }
    },
    methods: {
      get_cart() {
        axios.get('http://172.17.0.3:30101/get-cartung/1/ru').then((response) => {
          console.log(response.data);
          var data = response.data;
          this.cart = data.cart;
          this.products = new Array(data.products.length);
          this.products = data.products;
        });
      },
      clear_cart(id) {
        axios.get('http://172.17.0.3:30101/delete-cart/1/'+id+'/ru').then((response) => {
          this.$root.clearCartung();
        });
      },
      reload() {
        this.get_cart();
      }
    },
    mounted() {
      this.get_cart();
    }
  }
</script>
