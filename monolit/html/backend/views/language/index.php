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
        <?= Html::a('<i class="ion-plus-round"></i> ' . Yii::t('backend/pages', 'Добавить Язык'), ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
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
                            'attribute' => 'code',
                            'options' => ['width' => '8%']
                        ],
                        [
                            'attribute' => 'title',
                            'label' => Yii::t('backend/pages', 'Title'),
                            'value' => 'title'
                        ],
                        [
                            'attribute' => 'locale',
                            'label' => Yii::t('backend/pages', 'Locale'),
                            'value' => 'locale'
                        ],
                        ['class' => 'backend\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
<?php Pjax::end(); ?>