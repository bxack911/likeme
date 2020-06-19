<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UnitTypes */

$this->title = 'Create Unit Types';
$this->params['breadcrumbs'][] = ['label' => 'Unit Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
