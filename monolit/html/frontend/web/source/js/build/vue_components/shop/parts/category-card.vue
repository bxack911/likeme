<template>
  <div class="lg-grid-2 sm-grid-3 mc-grid-3 padded-sides">
    <div class="product_preview product_preview--product_list">
      <div class="product_preview-preview">
        <div class="product_preview-tips">
          <div class="product_preview-tip product_preview-tip--disc">{{ category.product_quantity }} тов.</div>
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
  export default {
    name: 'category-card',
    props: ['category']
  }
</script>
