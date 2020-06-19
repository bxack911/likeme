<template>
  <footer class="section--footer_copyright wrap">
    <div class="row">
      <div class="footer_block-left lg-grid-9 sm-grid-12 sm-padded-inner-bottom">
        <div class="grid-row">


          <div class="footer_block lg-grid-4 xs-grid-6 padded-sides">
            <div class="footer_block-h3">Покупателям</div>
            <ul class="footer_block-content menu menu--footer menu--horizontal">

              <li class="menu-node menu-node--footer">
                <a href="/page/delivery" class="menu-link ">
                  Доставка
                </a>
              </li>

              <li class="menu-node menu-node--footer">
                <a href="/page/oplata" class="menu-link ">
                  Оплата
                </a>
              </li>

              <li class="menu-node menu-node--footer">
                <a href="/page/vozvrat-tovara" class="menu-link ">
                  Возврат товара
                </a>
              </li>

              <li class="menu-node menu-node--footer">
                <a href="/client_account/login" class="menu-link ">
                  Личный кабинет
                </a>
              </li>

            </ul>
          </div>




          <div class="footer_block lg-grid-4 xs-grid-6 padded-sides">
            <div class="footer_block-h3">Информация</div>
            <ul class="footer_block-content menu menu--footer menu--horizontal">

              <li class="menu-node menu-node--footer">
                <a href="/page/o-nas" class="menu-link ">
                  О нас
                </a>
              </li>

              <li class="menu-node menu-node--footer">
                <a href="/page/faq" class="menu-link ">
                  FAQ
                </a>
              </li>

              <li class="menu-node menu-node--footer">
                <a href="/blogs/blog" class="menu-link ">
                  Блог
                </a>
              </li>

              <li class="menu-node menu-node--footer">
                <a href="/page/kontakty" class="menu-link ">
                  Контакты
                </a>
              </li>

              <li class="menu-node menu-node--footer">
                <a href="/page/feedback" class="menu-link ">
                  Обратная связь
                </a>
              </li>

            </ul>
          </div>


          <div class="footer_block social-menu lg-grid-4 xs-grid-6 mc-grid-12 padded-sides mc-padded-top">
            <div class="footer_block-h3">Мы на связи</div>

            <div class="footer-phone" id="phone_footer">
              <a href="tel:+7 (495) 123-45-67" title="Позвонить">+7 (495) 123-45-67</a>
            </div>
            <div class="footer-social">

              <a href="https://instagram.com/test" class="social-link" target="_blank" title="Instagram">
                <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/instagram_icon.svg" class="social-img">
              </a>


              <a href="https://vk.com/go.studio" class="social-link" target="_blank" title="Вконтакте">
                <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/vk_icon.svg" class="social-img">
              </a>


              <a href="https://www.facebook.com/" class="social-link" target="_blank" title="Facebook">
                <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/fb_icon.svg" class="social-img">
              </a>



            </div>

          </div>
        </div>
      </div><!-- footer_block-left -->
      <div class="footer_block-right lg-grid-3 sm-grid-12 sm-padded-inner-top mc-padded-top">


        <form method="POST" action="https://cp.unisender.com/ru/subscribe?hash=6xy53egzi5tud68prt14nzc6ixf1pkexmntb3j8mygwnws7uw7s7y" name="subscribtion_form" class="subscribe">
          <div class="footer_block-h3">Подписка на новости</div>
          <p>Получите доступ к эксклюзивным скидкам</p>
          <div class="subscribe-form-block">
            <input class="subscribe-form-item__control subscribe-form-item__control--input-email" type="text" placeholder="E-mail" name="email" value="">
            <input class="subscribe-form-item__btn subscribe-form-item__btn--btn-submit" type="submit" value="Подписаться" title="Подписаться">
          </div>
          <input type="hidden" name="charset" value="UTF-8">
          <input type="hidden" name="default_list_id" value="16503653">
          <input type="hidden" name="overwrite" value="2">
          <input type="hidden" name="is_v5" value="1">
        </form>


        <div class="copyright2">
          <div class="copyright-line first">Работает на <a href="https://www.insales.ru/?aff=150e6ac93" target="_blank">InSales</a></div>
          <div class="copyright-line">Разработка сайта – <a href="https://go-insales.ru" target="_blank">Go.Studio</a></div>
        </div>
      </div><!-- footer_block-left -->

      <div class="copyright lg-grid-12">
        Furnistore <i class="fa fa-copyright"></i> 2020
      </div>
    </div>


    <modals></modals>
  </footer>
</template>

<script>
  import modals from './modals';
  export default {
    name: 'main-footer',
    components: {
      modals: modals,
    }
  }
</script>
