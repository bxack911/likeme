<template>
  <div v-if="showing" class="lg-grid-2 sm-grid-3 mc-grid-3 padded-sides">
    <div class="product_preview product_preview--product_list">
      <div class="product_preview-preview">
        <div class="product_preview-tips">
          <div class="product_preview-tip product_preview-tip--disc">{{ category.product_quantity }} {{ getTranslation('prod') }}.</div>
        </div>
        <a :href="category.link" class="product_preview-image" :title="category.title">
          <picture><img :src="category.image" class="col-img image1" :alt="category.title" :title="category.title"/></picture>
        </a>
      </div>
      <div class="product_preview-title">
        <a :href="category.link"
           class="product_preview-link"
           title="Диван Textile Yellow">
          {{ category.title }}
        </a>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from "axios";

  export default {
    name: 'category-card',
    data() {
      return {
        showing: false,
        translations: [],
      }
    },
    props: ['category'],
    methods: {
      getTranslations: function() {
        axios.get(this.$microservices_url + this.$micro_others_port + '/get-translations').then((response) => {
          this.translations = response.data;
          this.showing = true;
        });
      },
      getTranslation: function(key) {
        return JSON.parse(this.translations[key].value)[this.$language];
      },
    },
    created() {
      this.getTranslations();
    }
  }
</script>
