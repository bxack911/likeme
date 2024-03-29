<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Pages;
use common\models\Section;
use common\models\Language;
use pendalf89\filemanager\widgets\FileInput;
use pendalf89\filemanager\widgets\TinyMCE;
//use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Material */
/* @var $form kartik\form\ActiveForm */

$languages = Language::findAllActive();

$sections = [];

$lang = Yii::$app->config->get('pagesLanguage');

$sections = [];
$list = Section::find()->active()->all();
array_walk($list, function ($model) use (&$sections) {
    $sections[$model->id] = $model->translate(Yii::$app->config->get('pagesLanguage'))->title;
});

?>

<?php $form = ActiveForm::begin(['id' => 'form', 'type' => ActiveForm::TYPE_HORIZONTAL, 'options' => ['enctype' => 'multipart/form-data']]); ?>

<div>
    <div>
        <div class="col-lg-9">
            <h3>Настройки страницы</h3>
            <div>
                <ul class="nav nav-tabs" id="contentTabs" role="tablist">
                    <li class="nav-item active">
                        <a href="#content" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">Контент</a>
                    </li>
                    <li class="nav-item" data-toggle="tab">
                        <a href="#imgs" data-toggle="tab" role="tab" aria-controls="imgs" aria-selected="true">Изображения</a>
                    </li>
                </ul>
                <div class="tab-content" id="contentTabsContent">
                    <div class="tab-pane fade row" id="imgs" role="tabpanel" aria-labelledby="imgs-tab">
                        <h3>Изображение страницы</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model,'image')->widget(FileInput::className(), [
                                    'buttonTag' => 'button',
                                    'buttonName' => 'Browse',
                                    'buttonOptions' => ['class' => 'btn btn-primary'],
                                    'options' => ['class' => 'form-control'],
                                    'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                                    'thumb' => 'original',
                                    'imageContainer' => '.img',
                                    'pasteData' => FileInput::DATA_ID,
                                    'callbackBeforeInsert' => 'function(e, data) {
                                        console.log( data );
                                    }',
                                ]); ?>
                            </div>
                            <div class="col-md-6">
                                <?php if($model->image): ?>
                                    <img src="<?= Pages::getImageUrl($model->image); ?>" alt="" />
                                <?php endif ?>
                            </div>
                        </div>
                        <h3>Галерея</h3>
                        <?= \zxbodya\yii2\galleryManager\GalleryManager::widget(
                            [
                                'model' => $model,
                                'behaviorName' => 'galleryBehavior',
                                'apiRoute' => 'pages/galleryApi'
                            ]
                        ); ?>
                    </div>
                    <div class="tab-pane fade active in" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <h3>Контент</h3>
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

                                    <?= $form->field($model->translate($language->code), '[' . $language->code . ']content')->widget(TinyMCE::className(), [
                                        'clientOptions' => [
                                            'language' => 'ru',
                                            'menubar' => true,
                                            'height' => 500,
                                            'image_dimensions' => false,
                                            'plugins' => [
                                                'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code contextmenu table',
                                            ],
                                            'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
                                        ],
                                    ]); ?>

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

        <!-- /translations -->
        <h3>Система</h3>
    <div class="col-lg-3 right_form_content">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'section_id')->dropDownList(
                    $sections,
                    [
                        'prompt' => '...',
                    ]
                ) ?>
            </div>
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
                Yii::$app->params['pagesActions']
            ) ?>
        </div>
    </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
