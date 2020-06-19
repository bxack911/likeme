<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Pages;

/* @var $this yii\web\View */
/* @var $section common\models\Section */
/* @var $searchModel backend\models\MaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

isset($searchModel->section_id) && ($section = Section::findOne($searchModel->section_id));

$this->title = Yii::t('backend/pages', 'Pages') . (isset($section) ? ' (' . $section->header . ')' : '');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="pull-right">
        <?= Html::a('<i class="ion-plus-round"></i> ' . Yii::t('backend/pages', 'Добавить конфигурацию'), ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
    </div>

<?php Pjax::begin(); ?>
<?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <h3>Языки</h3>
            <div class="content-panel">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => ['class' => 'table data-table table-striped'],
                    'layout' => "{items}\n{pager}\n{summary}",
                    'columns' => [
                        ['class' => 'yii\grid\CheckboxColumn'],

                        [
                            'attribute' => 'id',
                            'options' => ['width' => '8%']
                        ],
                        [
                            'attribute' => 'comment',
                            'label' => Yii::t('backend/config', 'Comment'),
                            'value' => 'comment'
                        ],
                        [
                            'attribute' => 'value',
                            'label' => Yii::t('backend/config', 'Value'),
                            'value' => 'value'
                        ],
                        [
                            'attribute' => 'key',
                            'label' => Yii::t('backend/config', 'Key'),
                            'value' => 'key'
                        ],
                        ['class' => 'backend\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
<?php Pjax::end(); ?>