<template>
  <div class="modals_container">
    <div class="modal modal--product_added center">
      <div class="modal-wrapper">
        <div class="modal-header">Товар добавлен в корзину</div>
        <span class="button button--borderjs-modal-close" v-on:click="hide">Продолжить покупки</span>
        <a href="/shop/cart/page" class="button button--buy">Перейти в корзину</a>
      </div>
    </div>
    <div class="overlay" v-on:click="hide"></div>
  </div>
</template>

<script>
  export default {
    name: 'modals',
    methods: {
      hide() {
        document.querySelector('.modal--product_added').setAttribute("style", 'display: none');
        document.querySelector('.overlay').setAttribute("style", 'display: none');
      }
    },
  }
</script>
