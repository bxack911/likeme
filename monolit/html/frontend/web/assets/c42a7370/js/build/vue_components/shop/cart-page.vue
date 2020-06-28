<template>
  <div>
    <div class="notice notice--warning js-cart-notice" v-if="products == 0">
      В вашей корзине нет товаров
    </div>
    <div class="cart-table_container" v-if="products != 0">
      <div class="cart-items_list lg-grid-8 sm-grid-12 padded-inner-right sm-padded-zero">
        <div id="cart_order_line_268276726" class="cart_item grid-inline grid-inline-middle padded-inner-bottom" v-for="(product,index) in products">
          <div class="cart_item-image lg-grid-2 mc-grid-4 sm-padded-sides sm-padded-bottom">
            <a :href="product.link">
              <img :src="product.image" />
            </a>
          </div>
          <div class="cart_item-title lg-grid-3 sm-grid-4 mc-grid-8 lg-padded-sides xs-padded-sides">
            <a :href="product.link" class="cart_item-link">
              {{ product.title }}
            </a>
            <div class="cart_item-sku">арт. {{ product.articul }}</div>

          </div>

          <div class="cart_item-title lg-grid-1 sm-grid-1 mc-grid-r lg-padded-sides xs-padded-sides">
            {{ product.price }} грн.
          </div>

          <div class="cart_item-quantity-seperator lg-grid-1 sm-grid-1 mc-grid-r lg-padded-sides xs-padded-sides">
            х
          </div>

          <div class="cart_item-quantity lg-grid-3 mc-grid-6 lg-padded-sides center mc-left">
            <div class="quantity quantity--side">
              <input :id="'product_quantity'+index" type="text" class="quantity-input js-quantity-input" :value="products[index].quantity" v-on:keyup="sum(index,product.id)" />
              <div class="quantity-button quantity-button--minus button js-quantity-minus" v-on:click="decrease(index,product.id)">-</div>
              <div class="quantity-button quantity-button--plus button js-quantity-plus" v-on:click="increase(index,product.id)">+</div>
            </div>
          </div>

          <div class="cart_item-prices cart_item-prices--stock lg-grid-2 sm-grid-3 mc-grid-5 lg-padded-sides center">
            <span class="prices-current js-price_type-268276726">
              {{ product.sum }} грн
            </span>
          </div>

          <div class="cart_item-delete lg-grid-1 mc-grid-3 lg-padded-sides right">
            <a class="js-cart_item-delete" title="Удалить из корзины" v-on:click="delete_prod(index,product.id)">
              <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/cross_icon.svg">
            </a>
          </div>
        </div>
      </div>
      <div class="cart-items_sum lg-grid-4 sm-grid-12">
        <div class="discounts">
          <div class="discounts-kupon">
            <div class="discounts-input input input--inline ">
              <input type="text" id="kupon-number" class="discounts-field input-field" name="cart[coupon]" value="" placeholder="Промокод" />
              <input type="button" class="discounts-submit button--border button js-discounts-submit" value="Применить" />
            </div>

          </div><!-- discounts-kupon -->

        </div>


        <div class="cart_total" v-if="cart != 0">
          <div class="cart_total-title">Итого:</div>
          <div class="cart_total-price prices-current js-cart-total">
            {{ cart.sum }} грн.
          </div>
        </div>

        <a href="/order" class="button button--checkout js-cart-submit">Оформить заказ</a>

      </div>

      <input type="hidden" name="_method" value="put">
      <input type="hidden" name="make_order" value="" disabled="disabled">
    </div>
  </div>
</template>

<script>
  import axios from "axios";

  export default {
    name: 'cart-page',
    data() {
      return {
        cart: [],
        products: [],
        quantity: 0,
      }
    },
    methods: {
      decrease(index,id) {
        if(this.products[index].quantity > 1)
          this.products[index].quantity--;
        document.querySelector('#product_quantity' + index).value = this.products[index].quantity;
        this.add(index,id);
      },
      increase(index,id) {
        this.products[index].quantity++;
        document.querySelector('#product_quantity' + index).value = this.products[index].quantity;
        this.add(index,id);
      },
      sum(index,id) {
        this.products[index].quantity = document.querySelector('#product_quantity' + index).value;
        this.add(index,id);
      },
      add(index,id) {
        this.quantity = document.querySelector('#product_quantity' + index).value;
        axios.get('http://172.17.0.3:30101/get-cart/1/'+id+'/ru/sum/'+this.quantity).then((response) => {
          this.$root.reloadCartung();
          this.get_cart();
        });
      },
      delete_prod(index,id) {
        axios.get('http://172.17.0.3:30101/delete-cart/1/' + id + "/ru").then((response) => {
          this.$root.reloadCartung();
          this.get_cart();
        });
      },
      get_cart() {
        axios.get('http://172.17.0.3:30101/get-cartung/1/ru').then((response) => {
          var data = response.data;
          if(data[0] != undefined && data[1] != undefined){
            this.products = new Array(data[0].length);
            this.products = data[0];
            this.cart = data[1][1];
          }else{
            this.products = 0;
            this.cart = 0;
          }
        });
      },
    },
    mounted() {
      this.get_cart();
    }
  }
</script>
