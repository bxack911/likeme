<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('backend/products', 'Orders') . (isset($category) ? ' (' . $category->header . ')' : '');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="pull-right">
        <?= Html::a('<i class="ion-plus-round"></i> ' . Yii::t('backend/pages', 'Добавить заказ'), ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
    </div>

<?php Pjax::begin(); ?>
<?php //echo $this->render('_search', ['model' => $searchModel]); ?>
            <div class="card bg-white m-b">
                <div class="card-header">Товары</div>
                <div class="card-block p-a-0">
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'tableOptions' => ['class' => 'table m-b-0'],
                            'layout' => "{items}\n{pager}\n{summary}",
                            'columns' => [
                                ['class' => 'yii\grid\CheckboxColumn'],

                                [
                                    'attribute' => 'id',
                                    'options' => ['width' => '8%']
                                ],
                                'fio',
                                'sum',
                                'phone',
                                ['class' => 'backend\grid\ActionColumn'],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
<?php Pjax::end(); ?>
