<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Pages;
use common\models\Section;
use common\models\Language;
use pendalf89\filemanager\widgets\TinyMCE;

/* @var $this yii\web\View */
/* @var $model common\models\Material */
/* @var $form kartik\form\ActiveForm */

$languages = Language::findAllActive();

$lang = Yii::$app->config->get('pagesLanguage');

?>

<?php $form = ActiveForm::begin(['id' => 'form', 'type' => ActiveForm::TYPE_HORIZONTAL]); ?>

<div class="tab-content">
    <div>
        <div class="col-lg-12">
            <h3>Настройки блока</h3>
            <div>
                <!-- translations -->

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
                    <?= $form->field($model, 'name')->textInput() ?>

                    <?php $j = 0;
                    foreach ($languages as $language): ?>

                        <div class="tab-pane <?= $language->code == $lang ? 'active' : '' ?>" role="tabpanel"
                             id="lang-<?= $language->code ?>">
                            <?= $form->field($model->translate($language->code), '[' . $language->code . ']value')->widget(TinyMCE::className(), [
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
