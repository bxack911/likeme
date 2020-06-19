<template>
  <div>
    <div v-if="prod_count > 0">
      <div v-for="product in products">
        <product-card :product="product"></product-card>
      </div>
    </div>
    <div v-if="prod_count == 0" class="lg-grid-12">
      <div class="notice notice--warning js-cart-notice">Товаров не найдено</div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import productCard from './parts/product-card';

  export default {
    name: 'products-list',
    props: ['category'],
    data() {
      return {
        prod_count: 0,
        products: []
      }
    },
    components: {
      productCard: productCard,
    },
    methods: {
      productsList() {
        var url = (this.category == "favourite") ? '/shop/favourite/favourite' : '/vue/get-products/' + this.category;
        axios.get(url).then((r) => {
          this.products = new Array(r.data.length);
          this.prod_count = r.data.length;
          this.products = r.data;
        });
      },
      setFilters(products) {
        this.products = products;
        this.prod_count = products.length;
      }
    },
    created() {
      this.productsList();
    }
  }
</script>
