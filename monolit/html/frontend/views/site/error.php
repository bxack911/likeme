<?php

/** @var \common\models\Material $material */

use yii\helpers\Html;
use common\helpers\Image;
use common\models\ConfigItem;
use common\modules\block\widgets\Block;
$this->title = 'Ошибка 404';
?>
    
<section id="content">
    <div class="container">
        <div class="shop-banner line-scale zoom-image">
            <div class="banner-info">
                <h2 class="title30 color"><?= $this->title ?></h2>
                <div class="bread-crumb white">
                    <div class="bread-crumb white"><a href="/" class="white">Главная</a><span><?= $this->title ?></span></div>
                </div>
            </div>
        </div>
        <!-- ENd Banner -->
        <div class="content-shop">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <?php // $this->render('../blocks/sidebar') ?>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-12">
                    <div class="main-content-single">
                        <div class="single-head">
                            <h2 class="title30 font-bold"><?= $material->header2 ?></h2>
                        </div>	
                        <div class="desc"><?php //Block::widget(['key' => 'block_text_error_404']) ?></div>                    
                    </div>                                           
                </div>
            </div>
        </div>
        <!-- End Content Shop -->
    </div>
</section>    