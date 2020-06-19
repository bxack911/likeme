<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\SectionSearch;
use common\models\Section;

/**
 * Site controller
 */
class SectionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index','create','delete','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new SectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Section();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            foreach (Yii::$app->request->post('SectionTranslation', []) as $language => $data) {
                foreach ($data as $attribute => $translation) {
                    $model->translate($language)->$attribute = $translation;
                }
            }

            if($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('backend/section', 'Section "{item}" successfully created', ['item' => $model->translate(Yii::$app->config->get('pagesLanguage'))->title]));
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            foreach (Yii::$app->request->post('SectionTranslation', []) as $language => $data) {
                foreach ($data as $attribute => $translation) {
                    $model->translate($language)->$attribute = $translation;
                }
            }

            if($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('section/pages', 'Page "{item}" successfully updated', ['item' => $model->translate(Yii::$app->config->get('pagesLanguage'))->title]));
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->delete()) {
            if(\Yii::$app
                ->db
                ->createCommand()
                ->delete('section_translation', ['section_id' => $model->id])
                ->execute()) {
                Yii::$app->session->setFlash('success', Yii::t('backend/section', 'Page "{item}" successfully deleted', ['item' => $model->translate(Yii::$app->config->get('pagesLanguage'))->title]));
            }
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Section::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        }
    }
}
