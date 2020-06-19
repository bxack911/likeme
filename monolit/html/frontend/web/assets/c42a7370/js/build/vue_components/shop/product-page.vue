<template>
  <div v-if="rendered">
    <div class="product-gallery gallery lg-grid-6 sm-grid-6 xs-grid-12 padded-inner-bottom padded-inner-sides">
      <div class="product-gallery gallery">
        <div class="product-gallery--no_touch sm-hidden">
          <div class="gallery-large_image sm-hidden">
            <zoom-on-hover :img-normal="product[0].image2[0].url" :scale="2"></zoom-on-hover>
          </div>

          <div class="slider slider--gallery">
            <ul class="gallery-preview_list gallery-preview_list--horizontal slider-container owl-carousel js-slider--gallery">

              <li class="gallery-preview padded-sides" v-for="gallery in product[0].image2">
                <a :href="gallery.url" alt="" title=""
                   class="gallery-image gallery-image--current image-square"
                   data-zoom-id="MagicZoom" :data-image="gallery.url"  >
                  <img :src="gallery.url" class="sm-hidden xs-hidden" />
                  <img :src="gallery.url" class="js-product_gallery-preview_image lg-hidden md-hidden" />
                </a>
              </li>
            </ul>
          </div>
        </div>


        <div class="product-gallery--touch slider slider--gallery lg-hidden md-hidden">
          <div class="js-slider--phone_gallery owl-carousel owl-theme">

            <div class="item" v-for="gallery in product[0].image2"><img :src="gallery.url" alt="The Last of us"></div>

          </div>
        </div>
      </div>

    </div>

    <div class="product-info
                lg-grid-6 sm-grid-6 xs-grid-12
                padded-inner-sides
                padded-inner-bottom xs-padded-zero-bottom">
      <h1 class="product-title content-title">{{ product[0].title }}</h1>


      <div class="product-short_description editor">
        <p><span v-html="product[0].short_description"></span></p>
      </div>



      <div class="product-sku js-product-sku">
        Артикул:
        <span class="product-sku_field js-product-sku_field">
          {{ product[0].articul }}
        </span>
      </div>


      <div class="product-presence">
        Наличие:
        <span class="product-presence_field js-product-presence" v-if="product[0].available == 1">Есть в наличии</span>
        <span class="product-presence_field js-product-presence" v-if="product[0].available == 0"><strong>Нет в наличии</strong></span>
      </div>

      <div id="order" v-if="product[0].available == 1">


        <div class="product-variants">
          <div class="option_selector option_selector--cvet option_selector--span">
            <label class="option_selector-label option_selector-label--cvet">Цвет</label>
            <div class="option_selector-container option_selector-container--cvet">
              <span class="variant-span variant-span--cvet variant-span--active">желтый</span>
              <span class="variant-span variant-span--cvet">слоновая кость</span>
            </div>
          </div>
        </div>


        <div class="product-prices prices" v-if="product[0].prod_discount != 0">
          <span class="prices-old js-prices-old">{{ product[0].price }} грн.</span>
          <span class="prices-current js-prices-current">{{ product[0].discount_sum }} грн.</span>
        </div>
        <div class="product-prices prices" v-if="product[0].prod_discount == 0">
          <span class="prices-current js-prices-current">{{ product[0].price }} грн.</span>
        </div>

        <product-cartung :product="product[0].id" ref="product_cart"></product-cartung>


      </div>

      <div class="tubs grid-12">

        <div class="accordion js-accordion">

          <div class="accordion__item js-accordion-item">
            <div class="accordion-header js-accordion-header">Описание</div>
            <div class="accordion-body js-accordion-body">
              <div class="accordion-body__contents" v-html="product[0].description">

              </div>
            </div>
          </div><!-- end of accordion body -->



          <div class="accordion__item js-accordion-item">
            <div class="accordion-header js-accordion-header">Характеристики</div>
            <div class="accordion-body js-accordion-body">
              <div class="accordion-body__contents">
                <table class="product-properties">

                  <tr>
                    <td class="property-title lg-grid-4 xs-grid-5 mc-grid-12 padded-inner-right mc-padded-zero">Цвет ножек:</td>
                    <td class="property-values lg-grid-8 xs-grid-7 mc-grid-12 mc-padded-inner-bottom">

                      бук


                    </td>
                  </tr>

                  <tr>
                    <td class="property-title lg-grid-4 xs-grid-5 mc-grid-12 padded-inner-right mc-padded-zero">Каркас:</td>
                    <td class="property-values lg-grid-8 xs-grid-7 mc-grid-12 mc-padded-inner-bottom">

                      массив, мебельный щит


                    </td>
                  </tr>

                  <tr>
                    <td class="property-title lg-grid-4 xs-grid-5 mc-grid-12 padded-inner-right mc-padded-zero">Механизм:</td>
                    <td class="property-values lg-grid-8 xs-grid-7 mc-grid-12 mc-padded-inner-bottom">

                      пантограф


                    </td>
                  </tr>

                  <tr>
                    <td class="property-title lg-grid-4 xs-grid-5 mc-grid-12 padded-inner-right mc-padded-zero">Наполнение:</td>
                    <td class="property-values lg-grid-8 xs-grid-7 mc-grid-12 mc-padded-inner-bottom">

                      пружинная змейка, ППУ


                    </td>
                  </tr>

                  <tr>
                    <td class="property-title lg-grid-4 xs-grid-5 mc-grid-12 padded-inner-right mc-padded-zero">Материал ножек:</td>
                    <td class="property-values lg-grid-8 xs-grid-7 mc-grid-12 mc-padded-inner-bottom">

                      массив


                    </td>
                  </tr>

                  <tr>
                    <td class="property-title lg-grid-4 xs-grid-5 mc-grid-12 padded-inner-right mc-padded-zero">Наполнение подушек:</td>
                    <td class="property-values lg-grid-8 xs-grid-7 mc-grid-12 mc-padded-inner-bottom">

                      холлофайбер


                    </td>
                  </tr>

                </table>
              </div>
            </div>
          </div><!-- end of accordion body -->



          <div class="accordion__item js-accordion-item">
            <div class="accordion-header js-accordion-header">Отзывы <span class="accordion-count">1</span></div>
            <div class="accordion-body js-accordion-body">
              <div class="accordion-body__contents">
                <div>
                  <div id="reviews" class="reviews">


                    <ul class="reviews-list">


                      <li class="review">

                        <div class="review-rating rating">
                          <span class="review-rating-span">Оценка:</span>
                          <select class="js-rating-read_only">

                            <option value="1" >
                              1
                            </option>

                            <option value="2" >
                              2
                            </option>

                            <option value="3" >
                              3
                            </option>

                            <option value="4" >
                              4
                            </option>

                            <option value="5" selected="selected">
                              5
                            </option>

                          </select>
                        </div>


                        <div class="review-details">
                          <span class="review-name">Мария</span>
                          07.10.2019 13:50
                        </div>

                        <div class="review-content">
                          Отличный диван! Несмотря на казалось бы маркий цвет – абсолютно устойчив к загрязнениям. Своих денег однозначно стоит!
                        </div>


                        <div class="review-manager_reply">
                          <span>Ответ магазина:</span>
                          Спасибо за доверие, Мария!
                        </div>


                      </li>


                    </ul>


                  </div>

                  <div id="review_form"
                       class="review_form
              lg-grid-12 xs-grid-12
              padded-sides">
                    <form class="review-form" method="post" action="/product/divan-textile-yellow/reviews#review_form" enctype="multipart/form-data">

                      <div class="review_form-h3">Оставить отзыв</div>





                      <div class="notice notice--info">
                        Все поля обязательны к заполнению
                      </div>

                      <div class="review_form-input input input--required
                  ">

                        <input  type="text"
                                name="review[author]"
                                value=""
                                class="input-field"
                                placeholder="Ваше имя" />

                        <span class="input-notice notice notice--warning">
          Вы не представились
        </span>
                      </div>

                      <div class="review_form-input input input--required
                  ">

                        <input  type="email"
                                name="review[email]"
                                value=""
                                class="input-field"
                                placeholder="E-mail (на сайте не публикуется)" />

                        <span class="input-notice notice notice--warning">
          Неправильно введен e-mail
        </span>
                      </div>

                      <div class="review_form-input input input--required
                  ">

        <textarea name="review[content]"
                  rows="4"
                  class="input-field"
                  placeholder="Отзыв"
        ></textarea>

                        <span class="input-notice notice notice--warning">
          Нам интересно Ваше мнение о товаре
        </span>
                      </div>

                      <div class="review_form-input rating_wrapper">
                        <label for="rating" class="rating-label">Оцените товар:</label>

                        <select class="js-rating" name="review[rating]">
                          <option value="">a</option>

                          <option value="1">1</option>

                          <option value="2">2</option>

                          <option value="3">3</option>

                          <option value="4">4</option>

                          <option value="5">5</option>

                        </select>
                      </div>


                      <div id="captcha"
                           class="review_form-input input input--captcha input--required
                    "
                      >
          <span class="text-on-img">
            Наберите текст, изображённый на картинке
          </span>

                        <div id="captcha_challenge" class="input-captcha">
                          <img src="/ru_captcha" id="review_captcha_image" alt="CAPTCHA" class="rucaptcha-image" /><a href="javascript:void(0)" onclick="document.getElementById('review_captcha_image').src = '/ru_captcha?' + new Date().getTime();"><img src='/served_assets/captcha_reload.png' title='Обновить изображение' alt='Обновить изображение'/></a>
                        </div>

                        <input type="text"
                               name="review[captcha_solution]"
                               class="input-field"
                        />

                        <span class="input-notice notice notice--warning">
            Вы неправильно ввели текст с картинки
          </span>
                      </div>



                      <div class="notice notice--info">
                        Перед публикацией отзывы проходят модерацию
                      </div>


                      <input type="submit"
                             class="review_form-submit button js-review-submit"
                             value="Отправить отзыв"
                      />


                    </form>
                  </div>

                </div>

              </div>
            </div>
          </div><!-- end of accordion body -->

        </div><!-- end of accordion item -->

      </div>


      <div class="tubs grid-12">
        <div class="product-geo">
          <div class="product-geo-title js-messages" data-target="geo" data-type="text">
            Доставка в
            <span class="product-geo-city js-geo-city-current" data-target="geo" data-type="text">&hellip;</span>
          </div>
          <div class="product-geo-items js-geo-items"></div>
        </div>

        <div class="lg-grid-12 padded-inner-top product-geo-link">
          <a href="/page/delivery" target="_blank" title="Подробнее о доставке">Подробнее о доставке</a>
        </div>


      </div>


    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import productCartung from './parts/product-cartung';

  export default {
    name: 'product-page',
    props: ['model'],
    data() {
      return {
        product: null,
        rendered: false,
      }
    },
    components: {
      zoomOnHover: zoomOnHover,
      productCartung: productCartung,
    },
    methods: {
      get_product() {
        axios.get('/vue/get-product-page/' + this.model).then((response) => {
          this.product = response.data;
          this.rendered = true;
        });
      },
      owl_init() {
        $( '.js-slider--gallery' ).owlCarousel({
          responsive: {
            0:    { items: 1 },
            480:  { items: 1 },
            640:  { items: 1 },
            800:  { items: 2 },
            1100: { items: 3 }
          },
          slideBy: 'page',
          nav: true,
          navClass: ['slider-left--gallery slider-left owl-prev', 'slider-right--gallery slider-right owl-next'],
          navText: ['<i class="fa fa-angle-left" />', '<i class="fa fa-angle-right" />'],
          navContainerClass: 'slider-control--gallery owl-nav slider-control',
        });

        $(".js-slider--gallery .gallery-preview a").click(function(e){
          e.preventDefault();
          $(".gallery-large_image .zoom-on-hover .normal,.gallery-large_image .zoom-on-hover .zoom").attr('src',$(this).children('img').attr('src'));
        });
      },
      accordion_init() {
        $(".js-accordion-header").click(function(){
          $(this).next().slideToggle(200);
        });
      },
      reload_basket() {
        this.$refs.product_cart.reload_basket();
      }
    },
    created() {
      this.get_product();
    },
    mounted() {
      setTimeout(() => {
        this.owl_init();
        this.accordion_init();
      },1000);
    }
  }
</script>
