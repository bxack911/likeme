<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\BlocksSearch;
use common\models\Blocks;

/**
 * Site controller
 */
class BlocksController extends Controller
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
        $searchModel = new BlocksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Blocks();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            foreach (Yii::$app->request->post('BlocksTranslation', []) as $language => $data) {
                foreach ($data as $attribute => $translation) {
                    $model->translate($language)->$attribute = $translation;
                }
            }

            if($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('backend/pages', 'Block "{item}" successfully created', ['item' => $model->translate(Yii::$app->config->get('pagesLanguage'))->value]));
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

            foreach (Yii::$app->request->post('BlocksTranslation', []) as $language => $data) {
                foreach ($data as $attribute => $translation) {
                    $model->translate($language)->$attribute = $translation;
                }
            }

            if($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('backend/pages', 'Block "{item}" successfully updated', ['item' => $model->translate(Yii::$app->config->get('pagesLanguage'))->value]));
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
                ->delete('pages_translation', ['block_id' => $model->id])
                ->execute()) {
                Yii::$app->session->setFlash('success', Yii::t('backend/pages', 'Block "{item}" successfully deleted', ['item' => $model->translate(Yii::$app->config->get('pagesLanguage'))->value]));
            }
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Blocks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
        }
    }
}
