<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use common\modules\shop\common\models\Products;
use common\modules\shop\common\models\Properties;
use common\models\Language;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Material */
/* @var $form kartik\form\ActiveForm */

$languages = Language::findAllActive();

$lang = Yii::$app->config->get('pagesLanguage');

$properties = [];

$list = Properties::find()->where(['parent' => null])->all();
array_walk($list, function ($model) use (&$properties) {
  $properties[$model->id] = $model->translate(Yii::$app->config->get('pagesLanguage'))->name;
});

$products = [];

$list = Products::findAllActive();
array_walk($list, function ($model) use (&$products) {
  $products[$model->id] = $model->translate(Yii::$app->config->get('pagesLanguage'))->title;
});
?>

<?php $form = ActiveForm::begin(['id' => 'form', 'type' => ActiveForm::TYPE_HORIZONTAL, 'options' => ['enctype' => 'multipart/form-data']]); ?>

<div>
    <div>
        <div class="col-lg-8">
            <h3>Настройки характеристики</h3>
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
                        <?= $form->field($model, 'product_id')->widget(Select2::classname(), [
                          'data' => $products,
                          'language' => 'de',
                          'options' => ['placeholder' => 'Привязать к товару...'],
                          'pluginOptions' => [
                            'allowClear' => true
                          ],
                        ]); ?>

                        <?= $form->field($model, 'parent')->widget(Select2::classname(), [
                          'data' => $properties,
                          'language' => 'de',
                          'options' => ['placeholder' => 'Категория...'],
                          'pluginOptions' => [
                            'allowClear' => true
                          ],
                        ]); ?>

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
                                    <?= $form->field($model->translate($language->code), '[' . $language->code . ']value')->textInput() ?>
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
</div>

<?php ActiveForm::end(); ?>
