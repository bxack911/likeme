<template>
  <form action="/collection/divany"
        method="get"
        class="sort_by
            lg-fr md-fr">

    <span class="sort_by-option">
      <label  for="order" class="sort_by-label sm-hidden xs-hidden">
        Сортировать
      </label>

      <div class="styled_select-wrapper">
        <select id="order" name="order" value=""
                class="sort_by-select js-sort_by js-styled">
          <option  value=''>по умолчанию</option>
          <option  value='price'>по возрастанию цены</option>
          <option  value='descending_price'>по убыванию цены</option>
          <option  value='title'>алфавиту А-Я</option>
          <option  value='descending_title'>алфавиту Я-А</option>
          <option  value='descending_age'>новые - старые</option>
          <option  value='age'>старые - новые</option>
        </select>
      </div>
    </span>


    <span class="sort_by-option fr">
      <label  for="page_size" class="sort_by-label  sm-hidden xs-hidden">
        Показывать
      </label>
      <div class="styled_select-wrapper">
        <select id="page_size" name="page_size" value=""
                class="sort_by-select js-sort_by js-styled">
          <option  value='24'>24</option>
          <option  value='36'>36</option>
          <option  value='96'>96</option>
        </select>
      </div>
    </span>


    <input type="hidden" name="price_min" value="6589" >

    <input type="hidden" name="price_max" value="30990" >
  </form>
</template>

<script>
  export default {
    name: "shop-sort"
  }
</script>
