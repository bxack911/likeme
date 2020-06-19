<template>
  <section>
    <div class="slider slider--index ">
      <div class="slider-container
                owl-carousel
                js-slider-index
                lg-grid-12 sm-grid-12 xs-grid-12 mc-grid-12">
        <div v-for="slide in slides">
          <a :href="slide.link" class="item">
            <div class="slider-text">
              <div class="slider-text-inner">
                <div class="slider-text-top">{{ slide.title }}</div>
                <div class="slider-text-center">{{ slide.html }}</div>
                <div class="slider-text-btn button">{{ translations.button }}</div>
              </div>
            </div>
            <div class="slider-image">
              <picture><img :src="slide.image" /></picture>

            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  import axios from 'axios';
  //import slide from './parts/slide';

  export default {
    name: "slider",
    data() {
      return {
        slides: [],
        translations: [],
      }
    },
    methods: {
      owl_init(){
        $(document).ready(function(){
          $('.js-slider-index').owlCarousel({
            items: 1,
            loop: true,
            dots: true,
            merge:true,
            nav: true,
            lazyLoad: true,
            animateOut: 'fadeOutDown',
            animateIn: 'fadeInUp',
            autoplay: false,
            autoplayTimeout: 15000,
            dotClass: 'owl-dot slider-dot',
            navClass: ['slider-left--index slider-left owl-prev', 'slider-right--index slider-right owl-next'],
            navText: ['<i class="fa fa-angle-left" />', '<i class="fa fa-angle-right" />'],
          });
        });
      },
      get_slider(){
        axios
          .get('http://172.17.0.3:30201/get-units/ru/1')
          .then((response) => {
            this.slides = new Array(response. data.length);
            this.slides = response.data;
          });
      },
      get_translations() {
        var object = this;
        axios.get('/vue/slider-translations')
        .then((r) => {
          this.translations = new Array(r.data.length);
          this.translations = r.data;
        });
      },
    },
    mounted: function() {
      this.get_translations();
      this.get_slider();
      setTimeout(() => {
        this.owl_init();
      },150);
    }
  }
</script>
