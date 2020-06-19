<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Section;
use common\models\Language;
//use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Material */
/* @var $form kartik\form\ActiveForm */

$languages = Language::findAllActive();
$lang = Yii::$app->config->get('pagesLanguage');
$sections = [];

?>

<?php $form = ActiveForm::begin(['id' => 'form', 'type' => ActiveForm::TYPE_HORIZONTAL, 'options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="tab-content">
    <div>
        <div class="col-lg-9">
            <h3>Настройки страницы</h3>
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

                    <?php $j = 0;
                    foreach ($languages as $language): ?>

                        <div class="tab-pane <?= $language->code == $lang ? 'active' : '' ?>" role="tabpanel"
                             id="lang-<?= $language->code ?>">

                            <?= $form->field($model->translate($language->code), '[' . $language->code . ']title')->textInput() ?>

                            <?= $form->field($model->translate($language->code), '[' . $language->code . ']content')->widget(\mihaildev\ckeditor\CKEditor::className(), [
                                'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
                                    'preset' => 'full',
                                    'language' => Yii::$app->language
                                ]),
                            ]) ?>

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
        <h3>Система</h3>
    <div class="col-lg-3 right_form_content">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'slug', [
                    'addon' => [
                        'prepend' => [
                            'content' => '/'
                        ]
                    ]
                ])->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div>
            <?= $form->field($model->route, 'route')->dropDownList(
                [$model->defaultRoute => Yii::t('backend', 'Default')] +
                Yii::$app->params['sectionActions']
            ) ?>
        </div>
    </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
