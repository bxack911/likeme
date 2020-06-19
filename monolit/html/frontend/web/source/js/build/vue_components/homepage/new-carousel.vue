<template>
  <div class="index">
    <div class="slider slider--product slider--index_product">

      <div class="titler">
        <a href="/collection/frontpage">
          Новые поступления
        </a>
      </div>

      <div class="row">
        <div class="slider-container owl-carousel js-slider--index_product">
          <div class="product_preview" v-for="product in products">
            <product-carousel-card :product="product"></product-carousel-card>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import productCarouselCard from './../shop/parts/product-carousel-card';

  export default{
    name: "new-carousel",
    components: {
      productCarouselCard: productCarouselCard
    },
    data() {
      return {
        products: []
      }
    },
    methods: {
      get_products() {
        axios.get('/vue/get-products/new').then((response) => {
          this.products = new Array(response.data.length);
          this.products = response.data;
          setTimeout(() => {
            this.owl_init();
          },1000);
        });
      },
      owl_init() {
        $( '.js-slider--index_product' ).owlCarousel({
          responsive: {
            0:    { items: 2 },
            480:  { items: 2 },
            640:  { items: 3 },
            800:  { items: 4 },
            1100: { items: 5 }
          },
          slideBy: 'page',
          margin: 16,
          dots: true,
          autoplay: true,
          autoplayTimeout: 5000,
          autoplayHoverPause: true,
          navClass: ['button', 'button'],
          dotClass: 'owl-dot slider-dot',
          navClass: ['button slider-left owl-prev', 'button slider-right owl-next'],
          navText: ['<i class="fa fa-angle-left" />', '<i class="fa fa-angle-right" />'],
          navContainerClass: 'slider-control--product',
        });
      }
    },
    created() {
      this.get_products();
    },
  }
</script>
