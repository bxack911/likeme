<?php

use yii\helpers\Html;
use common\models\Strings;
use kartik\form\ActiveForm;
use common\models\Language;
use pendalf89\filemanager\widgets\FileInput;
use pendalf89\filemanager\widgets\TinyMCE;
//use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Material */
/* @var $form kartik\form\ActiveForm */

$languages = Language::findAllActive();

$sections = [];

$lang = Yii::$app->config->get('pagesLanguage');

?>

<?php $form = ActiveForm::begin(['id' => 'form', 'type' => ActiveForm::TYPE_HORIZONTAL, 'options' => ['enctype' => 'multipart/form-data']]); ?>

<div>
    <div>
        <div class="col-lg-9">
            <h3>Перевод</h3>
            <div>
                <ul class="nav nav-tabs" id="contentTabs" role="tablist">
                    <li class="nav-item active">
                        <a href="#content" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">Контент</a>
                    </li>
                </ul>
                <div class="tab-content" id="contentTabsContent">
                    <div class="tab-pane fade active in" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <h3>Контент</h3>
                      <?= $form->field($model, 'str_key')->textInput() ?>
                        <!-- translations -->

                        <ul class="nav nav-tabs" role="tablist">
                            <?php foreach ($languages as $i => $language): ?>
                                <li role="presentation" class="<?= $language->code == $lang ? 'active' : '' ?>">
                                    <a href="#lang-<?= $language->code ?>" aria-controls="lang-<?= $language->code ?>" role="tab"
                                       data-toggle="tab">
                                        <?= Html::tag('i', '', ['class' => $language->code, 'style' => 'margin-right: 5px;']) ?>
                                        <?= Yii::t('common/language', $language->title) ?>
                                    </a>
                                </li>
                                <?php endforeach ?>
                        </ul>

                        <div class="tab-content">

                            <?php
                            foreach ($languages as $j => $language): ?>

                                <div class="tab-pane <?= $language->code == $lang ? 'active' : '' ?>" role="tabpanel"
                                     id="lang-<?= $language->code ?>">

                                    <?= $form->field($model->translate($language->code), '[' . $language->code . ']value')->textInput() ?>

                                </div>

                                <?php endforeach ?>

                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="pull-left">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <!-- /translations -->
    </div>
</div>

<?php ActiveForm::end(); ?>
