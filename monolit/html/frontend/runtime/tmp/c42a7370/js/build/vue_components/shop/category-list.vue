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
        axios.get('/vue/get-cats/' + this.category).then((response) => {
          this.categories = new Array(response.data.length);
          this.categories = response.data;
          console.log(this.category);
        });
      }
    },
    mounted() {
      this.get_child();
    }
  }
</script>
