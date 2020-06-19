<template>
  <div>
    <form action="/search" method="get" class="search_widget search_widget--header">
      <input type="text" v-model="key" v-on:keyup="get_result" name="q" value="" placeholder="Поиск" class="search_widget-field" />
      <button type="submit" class="search_widget-submit">
        <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/search_icon.svg">
      </button>
    </form>
    <div class="header_search_results" v-if="search_on">
      <div class="search_item" v-for="product in search_results">
        <div class="img"><a :href="product.link"><img :src="product.image" alt=""></a></div>
        <div class="medium">
          <div class="title"><a :href="product.link">{{ product.title }}</a></div>
          <div class="articul">Артикул: {{ product.articul }}</div>
        </div>
        <div class="price">
          <div class="product-prices prices" v-if="product.prod_discount != 0">
            <span class="prices-old js-prices-old">{{ product.price }} грн.</span>
            <span class="prices-current js-prices-current">{{ product.discount_sum }} грн.</span>
          </div>
          <div class="product-prices prices" v-if="product.prod_discount == 0">
            <span class="prices-current js-prices-current">{{ product.price }} грн.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    name: 'search-form',
    data() {
      return {
        key: '',
        search_results: [],
        search_on: false,
      }
    },
    methods: {
      get_result() {
        if(this.key != "") {
          axios.post('/shop/search/get-results', {
            key: this.key
          }, {
            headers: {
              'Content-Type': 'application/form-data'
            }
          }).then((response) => {
            this.search_results = new Array(response.data.length);
            if (response.data[0].length != 0) {
              this.search_results = response.data;
              this.search_on = true;
            } else {
              this.search_on = false;
            }

            console.log(this.search_results);
          });
        }else{
          this.search_on = false;
        }
      }
    }
  }
</script>
