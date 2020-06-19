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
            <h3>Добавление языка</h3>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'locale')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
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
