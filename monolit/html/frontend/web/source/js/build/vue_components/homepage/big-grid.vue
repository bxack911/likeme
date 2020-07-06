<template>
  <div>
    <div class="index-coll grid-row-inner">
        <div class="lg-grid-4 mc-grid-12 index-coll-div padded-inner mc-padded-zero-sides" v-if="big_blocks[0]">
          <a :href="big_blocks[0].link" class="index-coll-block">
            <div class="index-coll-img">
              <img :src="big_blocks[0].image" :title="big_blocks[0].title" />
            </div>
            <div class="index-coll-text">{{ big_blocks[0].title }}</div>
            <div class="col-hover"></div></a>
        </div>

      <div class="lg-grid-8 mc-grid-12 index-coll-div padded-inner mc-padded-zero-sides" v-if="big_blocks[1]">
        <a href="/collection/kancelaria" class="index-coll-block">
          <div class="index-coll-img">
            <img :src="big_blocks[1].image" :title="big_blocks[1].title" />
          </div>
          <div class="index-coll-text-big">
            <p>{{ big_blocks[1].title }}</p>
            <span>{{ translations.button }}</span>
          </div>
          <div class="col-hover"></div>
        </a>
      </div>

      <div class="lg-grid-8 mc-grid-12 index-coll-div padded-inner mc-padded-zero-sides" v-if="big_blocks[2]">
        <a :href="big_blocks[2].link" class="index-coll-block">
          <div class="index-coll-img">
            <img :src="big_blocks[2].image" :title="big_blocks[2].title" />
          </div>
          <div class="index-coll-text-big">
            <p>{{ big_blocks[2].title }}</p>
            <span>{{ translations.button }}</span>
          </div>
          <div class="col-hover"></div>
        </a>
      </div>

      <div class="lg-grid-4 mc-grid-12 index-coll-div padded-inner mc-padded-zero-sides" v-if="big_blocks[3]">
        <a href="/collection/stulia" class="index-coll-block">
          <div class="index-coll-img">
            <img :src="big_blocks[3].image" :title="big_blocks[3].title" />
          </div>
          <div class="index-coll-text">{{ big_blocks[3].title }}</div>
          <div class="col-hover"></div></a>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    name: "big-grid",
    data() {
      return {
        big_blocks: [],
        translations: [],
      }
    },
    methods: {
      get_blocks (){
        var object = this;
        axios
                .get(this.$microservices_url + this.$micro_others_port + '/get-units/ru/2')
                .then(function(r){
                  object.big_blocks = new Array(r. data.length);
                  object.big_blocks = r.data;
                });
      },
      get_translations() {
        var object = this;
        axios.get('/vue/slider-translations')
                .then(function(r){
                  object.translations = new Array(r.data.length);
                  object.translations = r.data;
                });
      },
    },
    mounted: function() {
      this.get_translations();
      this.get_blocks();
    }
  }
</script>
