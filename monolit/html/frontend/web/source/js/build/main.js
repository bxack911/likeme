import Vue from 'vue';

/* START common components */
import topHeader from './vue_components/common/top-header';
import mainFooter from "./vue_components/common/main-footer";
import modals from './vue_components/common/modals';
/* END common components */

/* START homepage components */
import slider from './vue_components/homepage/slider';
import bigGrid from './vue_components/homepage/big-grid';
import newCarousel from './vue_components/homepage/new-carousel';
import specOffer from './vue_components/homepage/spec-offer';
import instagram from './vue_components/homepage/instagram';
/* END homepage components */

/* START shop components */
import shopFilter from './vue_components/shop/shop-filter';
import shopSort from './vue_components/shop/shop-sort';
import productsList from './vue_components/shop/products-list';
import categoryList from './vue_components/shop/category-list';
import productPage from './vue_components/shop/product-page';
import cartPage from './vue_components/shop/cart-page';
/* END shop components */

/* START shop partials */
import productCard from './vue_components/shop/parts/product-card';
/* START settings */

Vue.prototype.$microservices_url = "http://192.168.39.195";
Vue.prototype.$micro_products_port = ":30101";
Vue.prototype.$micro_others_port = ":30201";
Vue.prototype.$language = "ru";

import axios from 'axios';

new Vue({
  el: '#app',
  components: {
    topHeader: topHeader,
    mainFooter: mainFooter,
    modals: modals,

    slider: slider,
    bigGrid: bigGrid,
    newCarousel: newCarousel,
    specOffer: specOffer,
    instagram: instagram,

    shopFilter: shopFilter,
    shopSort: shopSort,
    productsList: productsList,
    categoryList: categoryList,
    productPage: productPage,
    cartPage: cartPage,

    productCard: productCard,
  },
  methods: {
    reloadCartung: function(){
      this.$refs.header.reload_basket();
    },
    reloadProductsList: function() {
      this.$refs.product_list.productsList();
    },
    clearCartung: function() {
      this.$refs.header.reload_basket();
      this.$refs.product_page.reload_basket();
    },
    setFilters: function(products) {
      this.$refs.product_list.setFilters(products);
    },
  },
})
