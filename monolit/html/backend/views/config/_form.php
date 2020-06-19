<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Pages;
use common\models\Language;

/* @var $this yii\web\View */
/* @var $model common\models\Material */
/* @var $form kartik\form\ActiveForm */

?>

<?php $form = ActiveForm::begin(['id' => 'form', 'type' => ActiveForm::TYPE_HORIZONTAL, 'options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="tab-content">
    <div>
        <div class="col-lg-12">
            <h3>Системные настройки</h3>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4">
                        <?php if($model->key == "pagesLanguage"): ?>
                            <?= $form->field($model, 'value')->dropDownList([
                                ArrayHelper::map(Language::findAllActive(),'code','code'),
                            ]) ?>
                        <?php else: ?>
                            <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
                        <?php endif ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>
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
