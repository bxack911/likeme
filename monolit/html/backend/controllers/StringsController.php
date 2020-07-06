<?php
namespace backend\controllers;

use common\helpers\FileHelper;
use http\Env\Response;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\StringsSearch;
use common\models\Strings;
use common\models\ImageValidate;

/**
 * Site controller
 */
class StringsController extends Controller
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
    $searchModel = new StringsSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionUpload()
  {

  }

  public function actionCreate()
  {
    $model = new Strings();
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {

      $data = Yii::$app->request->post();

      foreach (Yii::$app->request->post('StringsTranslation', []) as $language => $data) {
        foreach ($data as $attribute => $translation) {
          $model->translate($language)->$attribute = $translation;
        }
      }

      if($model->save()) {
        Yii::$app->session->setFlash('success', Yii::t('backend/pages', 'String "{item}" successfully created', ['item' => $model->translate(Yii::$app->config->get('pagesLanguage'))->value]));
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
      $data = Yii::$app->request->post();

      foreach (Yii::$app->request->post('StringsTranslation', []) as $language => $data) {
        foreach ($data as $attribute => $translation) {
          $model->translate($language)->$attribute = $translation;
        }
      }

      if($model->save()) {
        Yii::$app->session->setFlash('success', Yii::t('backend/pages', 'String "{item}" successfully updated', ['item' => $model->translate(Yii::$app->config->get('pagesLanguage'))->value]));
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
        ->delete('strings_translation', ['string_id' => $model->id])
        ->execute()) {
        Yii::$app->session->setFlash('success', Yii::t('backend/pages', 'String "{item}" successfully deleted', ['item' => $model->translate(Yii::$app->config->get('pagesLanguage'))->value]));
      }
    }

    return $this->redirect(['index']);
  }

  protected function findModel($id)
  {
    if (($model = Strings::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(Yii::t('backend', 'The requested string does not exist.'));
    }
  }
}
