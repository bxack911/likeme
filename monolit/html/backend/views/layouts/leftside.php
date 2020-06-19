<?php

use Yii\helpers\Url;

?>
<!-- sidebar panel -->
<div class="sidebar-panel offscreen-left">
    <div class="brand">
        <!-- toggle small sidebar menu -->
        <a href="javascript:;" class="toggle-apps hidden-xs" data-toggle="quick-launch">
            <i class="icon-grid"></i>
        </a>
        <!-- /toggle small sidebar menu -->
        <!-- toggle offscreen menu -->
        <div class="toggle-offscreen">
            <a href="javascript:;" class="visible-xs hamburger-icon" data-toggle="offscreen" data-move="ltr">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
        <!-- /toggle offscreen menu -->
        <!-- logo -->
        <a class="brand-logo">
            <span>Adminka</span>
        </a>
        <a href="#" class="small-menu-visible brand-logo">A</a>
        <!-- /logo -->
    </div>
    <ul class="quick-launch-apps hide">
        <li>
            <a href="apps-gallery.html">
            <span class="app-icon bg-danger text-white">
            C
            </span>
                <span class="app-title">Страницы</span>
            </a>
        </li>
        <li>
            <a href="apps-messages.html">
            <span class="app-icon bg-success text-white">
            К
            </span>
                <span class="app-title">Конфигурации</span>
            </a>
        </li>
        <li>
            <a href="apps-social.html">
            <span class="app-icon bg-primary text-white">
            Б
            </span>
                <span class="app-title">Блоки</span>
            </a>
        </li>
        <li>
            <a href="apps-travel.html">
            <span class="app-icon bg-info text-white">
            П
            </span>
                <span class="app-title">Профиль</span>
            </a>
        </li>
    </ul>
    <!-- main navigation -->
    <nav role="navigation">
        <ul class="nav">
            <!-- dashboard -->
            <li>
                <a href="index.html">
                    <i class="icon-compass"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
              <a href="javascript:;">
                <i class="icon-bag"></i>
                <span>Магазин</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="<?= Url::to(['/shop/category']) ?>">
                    <span>Категории</span>
                  </a>
                </li>
                <li>
                  <a href="<?= Url::to(['/shop/products']) ?>">
                    <span>Товары</span>
                  </a>
                </li>
                <li>
                  <a href="<?= Url::to(['/shop/properties']) ?>">
                    <span>Характеристики</span>
                  </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="javascript:;">
                <i class="icon-loop"></i>
                <span>Заказы</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="<?= Url::to(['/shop/order']) ?>">
                    <span>Мои заказы</span>
                  </a>
                </li>
                <li>
                  <a href="<?= Url::to(['/shop/addons/delivery']) ?>">
                    <span>Способы доставки</span>
                  </a>
                </li>
                <li>
                  <a href="<?= Url::to(['/shop/addons/paysystems']) ?>"">
                  <span>Способы оплаты</span>
                  </a>
                </li>
              </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-doc"></i>
                    <span>Страницы</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?= Url::to(['/pages']) ?>">
                            <span>Страницы</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/section']) ?>">
                            <span>Категории страниц</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-book-open"></i>
                    <span>Контент</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?= Url::to(['/menu']) ?>">
                            <span>Меню</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/blocks']) ?>">
                            <span>Доп. блоки</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/units']) ?>">
                            <span>Блоки с наполнением</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/unit-types']) ?>">
                            <span>Типы блоков с наполнением</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-settings"></i>
                    <span>Система</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?= Url::to(['/language']) ?>">
                            <span>Языки</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/config']) ?>">
                            <span>Конфигурации</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
              <a href="javascript:;">
                <i class="icon-drawer"></i>
                <span>Склад</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="ui-buttons.html">
                    <span>Поступления</span>
                  </a>
                </li>
                <li>
                  <a href="<?= Url::to(['/shop/products']) ?>">
                    <span>Анализатор</span>
                  </a>
                </li>
              </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="icon-share-alt"></i>
                    <span>Дополнительно</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="tables-basic.html">
                            <span>Рассылки email</span>
                        </a>
                    </li>
                    <li>
                        <a href="tables-responsive.html">
                            <span>Логи</span>
                        </a>
                    </li>
                    <li>
                      <a href="forms-plugins.html">
                        <span>Тикеты</span>
                      </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /main navigation -->
</div>
<!-- /sidebar panel -->
