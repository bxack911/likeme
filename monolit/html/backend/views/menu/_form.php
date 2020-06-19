<?php

use yii\helpers\Html;
use common\models\Language;
use common\models\MenuTranslation;

$languages = Language::findAllActive();
$lang = Yii::$app->config->get('pagesLanguage');

?>
<div class="tab-pane fade active in" id="content" role="tabpanel" aria-labelledby="content-tab">
  <ul class="nav nav-tabs" role="tablist">
    <?php $i = 0;
    foreach ($languages as $language): ?>
      <li role="presentation" class="<?= $language->code == $lang ? 'active' : '' ?>">
        <a href="#lang-<?= $language->code ?>" aria-controls="lang-<?= $language->code ?>" role="tab"
           data-toggle="tab">
          <?= Html::tag('i', '', ['class' => $language->code, 'style' => 'margin-right: 5px;']) ?>
          <?= Yii::t('common/language', $language->title) ?>
        </a>
      </li>
      <?php $i++; endforeach ?>
  </ul>

  <div class="tab-content">

    <?php $j = 0;
    foreach ($languages as $language): ?>

      <div class="tab-pane <?= $language->code == $lang ? 'active' : '' ?>" role="tabpanel"
           id="lang-<?= $language->code ?>">

        <?= $form->field($node->translate($language->code), '[' . $language->code . ']label')->textInput() ?>
      </div>

      <?php $j++; endforeach ?>

  </div>
</div>

<div class="row">
  <div class="col-sm-8">
    <?= $form->field($node, 'url', [
      'addon' => [
        'prepend' => [
          'content' => '/'
        ]
      ]
    ])->textInput() ?>
  </div>
</div>
