<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use common\modules\shop\common\models\addons\Delivery;
use common\models\Language;
use pendalf89\filemanager\widgets\TinyMCE;

/* @var $this yii\web\View */
/* @var $model common\models\Material */
/* @var $form kartik\form\ActiveForm */

$languages = Language::findAllActive();


$lang = Yii::$app->config->get('pagesLanguage');


?>

<?php $form = ActiveForm::begin(['id' => 'form', 'type' => ActiveForm::TYPE_HORIZONTAL, 'options' => ['enctype' => 'multipart/form-data']]); ?>

<div>
    <div>
        <div class="col-lg-8">
            <h3>Настройки способа оплаты</h3>
            <div>
                <ul class="nav nav-tabs" id="contentTabs" role="tablist">
                    <li class="nav-item active">
                        <a href="#content" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">Контент</a>
                    </li>
                </ul>
                <div class="tab-content" id="contentTabsContent">
                    <div class="tab-pane fade active in" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <h3>Контент</h3>
                        <!-- translations -->
                        <?= $form->field($model, 'sum')->textInput() ?>
                        <?= $form->field($model, 'class')->textInput() ?>
                        <?= $form->field($model, 'status')->dropDownList([
                          1 => Yii::t('backend', 'Active'),
                          0 => Yii::t('backend', 'Inactive')
                        ]) ?>

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

                                    <?= $form->field($model->translate($language->code), '[' . $language->code . ']name')->textInput() ?>

                                    <?= $form->field($model->translate($language->code), '[' . $language->code . ']comment')->widget(TinyMCE::className(), [
                                        'clientOptions' => [
                                            'language' => 'ru',
                                            'menubar' => true,
                                            'height' => 500,
                                            'image_dimensions' => false,
                                            'plugins' => [
                                                'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
                                            ],
                                            'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                                        ],
                                    ]); ?>

                                </div>

                                <?php $j++; endforeach ?>

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
    </div>
</div>

<?php ActiveForm::end(); ?>
