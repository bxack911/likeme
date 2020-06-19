<template>
  <div>
    <div v-for="model in categories">
      <category-card :category="model"></category-card>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import categoryCard from './parts/category-card'

  export default {
    name: 'category-list',
    components: {
      categoryCard: categoryCard
    },
    data() {
      return {
        categories: [],
      }
    },
    props: ['category'],
    methods: {
      get_child() {
        axios.get('http://172.17.0.3:30101/get-cats/ru/' + this.category).then((response) => {
          this.categories = new Array(response.data.length);
          this.categories = response.data;
        });
      }
    },
    mounted() {
      this.get_child();
    }
  }
</script>
