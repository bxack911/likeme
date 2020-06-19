<template>
      <div class="lg-grid-3 sm-hidden xs-hidden padded-inner-sides md-padded-sides sticky-sidebar">
        <div class="sidebar" v-if="rendered">
          <div class="sidebar_block">
            <div class="sidebar_block-title">Фильтр</div>
            <div class="sidebar_block-content">
              <div id="characteristics" class="filter filter--vertical filter-- js-filter-sections_wrapper">
                <div class="filter-section js-filter_section-wrapper" >
                  <label id="filter_section-price" class="filter_section-title js-filter_section-toggler"><span>Цена</span>
                    <span class="button--marker button filter_section-toggler"><i class="fa fa-angle-up"></i></span>
                  </label>
                  <div class="filter_section-values filter_section-values--range js-section-range js-filter_section-values">
                    <div class="vue-slider-component vue-slider-horizontal vue-slider-state-drag">
                      <vue-slider
                        v-model="prices"
                        :tooltip="'always'"
                        :tooltip-placement="'top'"
                        :tooltip-formatter="'{value} грн.'"
                        :min="filters.price.min"
                        :max="filters.price.max">
                      </vue-slider>
                    </div>
                  </div>
                </div>

                <div class="filter-section js-filter_section-wrapper" v-for="filter in filters.props">
                  <label class="filter_section-title js-filter_section-toggler"><span>{{ filter['prop'].name }}</span><i class="fa fa-angle-down"></i></label>
                  <ul class="filter_section-values filter_section-values--collapse js-filter_section-values padded">
                    <li class="filter_section-value" v-for="prop in filter['childs']">
                      <input v-model="properties['properties']['props']" type="checkbox" :value="prop.id" class="filter_section-value_input js-filter_section-value_input"/>
                      <a class="filter_section-value_link js-filter_section-value_link">{{ prop.name }}</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <button v-on:click="set_filters" class="filter_button co-button co-button--checkout js-button-checkout_submit" id="create_order">Применить</button>
          </div>
        </div>
      </div>
</template>

<script>
  import axios from 'axios';
  import vueSlider from 'vue-slider-component';

  export default {
    name: "shop-filter",
    props: ['category'],
    data(){
      return {
        prices: [1,1],
        filters: [],
        rendered: false,
        properties: []
      }
    },
    components: {
      vueSlider: vueSlider
    },
    methods: {
      get_filters() {
        axios.get('/shop/filter/get-filters/' + this.category).then((response) => {
          this.filters = new Array(response.data.length);
          this.filters = response.data;
          this.prices = [
            this.filters.price.min,
            this.filters.price.max
          ];
          this.rendered = true;
          setTimeout(() => {
            this.set_dropdowns();
          },1000);
        });
      },
      set_dropdowns() {
        $(".js-filter_section-toggler i").click(function(){
          $(this).parent().parent().find('.filter_section-values').slideToggle(200);
        });

        $(".js-filter_section-toggler#filter_section-price i").click(function(){
          $(this).parent().parent().parent().find('.filter_section-values').slideToggle(200);
        });
      },
      set_filters() {
        this.properties['properties']['min_price'] = this.prices[0];
        this.properties['properties']['max_price'] = this.prices[1];

        console.log(this.properties['properties']);

        axios.post('/shop/filter/set-filters/' + this.category, {
          min_price: this.prices[0],
          max_price: this.prices[1],
          props: this.properties['properties']['props'],
        }, {
          headers: {
            'Content-Type': 'application/form-data'
          }
        }).then((response) => {
            this.$root.setFilters(response.data);
        });
      }
    },
    created() {
      this.properties['properties'] = [];
      this.properties['properties']['props'] = [];
      this.get_filters();
    }
  }
</script>
