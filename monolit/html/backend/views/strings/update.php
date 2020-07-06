<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Material */

$this->title = Yii::t('backend', 'Update "{item}"', ['item' => $model->translate(Yii::$app->config->get('materialsLanguage'))->value]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/material', 'Strings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-wrapper">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
