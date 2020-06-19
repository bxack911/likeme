<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\ShopAsset;
use frontend\widgets\MenuWidget;
use common\models\Blocks;

ShopAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<?php $this->beginBody() ?>

<div id="app" class="adaptive">
  <header class="">

    <div class="section--topbar xs-hidden">
      <div class="row">
        <div class="lg-grid-8 sm-grid-6 topbar-left">
          <p><?= Blocks::getByName('header_left_label') ?></p>
        </div>
        <div class="lg-grid-4 sm-grid-6 topbar-right right"><?= Blocks::getByName('header_right') ?></div>
      </div>
    </div>

    <div class="section--header">
      <div class=" header-padded">
        <div class="lg-grid-2 md-grid-12
                  md-center sm-padded-inner-bottom lg-padded-inner-right md-padded-zero-right md-padded-inner-bottom">
          <a href="/" class="logo lg-padded-inner-right xs-padded-zero">

            <img src="https://assets3.insales.ru/assets/1/7887/1285839/1586265738/logo.png" alt="Furnistore"
                 title="Furnistore"/>

          </a>

        </div>

        <div class="section--main_menu lg-grid-6 sm-grid-4">
          <div class="sm-hidden xs-hidden">
            <?= MenuWidget::widget(['root' => 11]) ?>
          </div>

          <div class="center lg-hidden md-hidden menu menu--main menu-mobile">
              <li class="menu-node menu-node--main_lvl_1">
                <span class="menu-link mobile_menu">
                  <i class="fa fa-bars"></i>
                  <span>
                    Каталог
                  </span>
                </span>
              </li>
          </div>
        </div>
        <top-header ref="header"></top-header>
      </div>
    </div>
  </header>
  <section class="section--content section--index">
        <?= $content ?>
  </section>
  <main-footer></main-footer>
</div>

<?php $this->endBody() ?>
<script></script>
</body>
</html>
<?php $this->endPage() ?>
