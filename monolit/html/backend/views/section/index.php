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
        <?= Html::a('<i class="ion-plus-round"></i> ' . Yii::t('backend/pages', 'Добавить страницу'), ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
    </div>

<?php Pjax::begin(); ?>
<?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <h3>Страницы</h3>
            <div class="content-panel">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table data-table table-striped'],
                    'layout' => "{items}\n{pager}\n{summary}",
                    'columns' => [
                        ['class' => 'yii\grid\CheckboxColumn'],

                        [
                            'attribute' => 'id',
                            'options' => ['width' => '8%']
                        ],
                        [
                            'attribute' => 'title',
                            'label' => Yii::t('backend/pages', 'Title'),
                            'value' => function ($model) {
                                return $model->translate(Yii::$app->config->get('pagesLanguage'))->title;
                            }

                        ],
                        [
                            'attribute' => 'slug',
                            'value' => 'url'
                        ],
                        // 'created_at',
                        // 'created_by',
                        // 'updated_by',
                        ['class' => 'backend\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
<?php Pjax::end(); ?>