<?php
namespace common\modules\shop\backend\controllers\addons;

use common\helpers\FileHelper;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\modules\shop\backend\models\PaysystemsSearch;
use common\modules\shop\common\models\addons\Paysystems;
use common\models\ImageValidate;

/**
 * Site controller
 */
class PaysystemsController extends Controller
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
    $searchModel = new PaysystemsSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionCreate()
  {
    $model = new Paysystems();
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {

      $data = Yii::$app->request->post();

      foreach (Yii::$app->request->post('PaysystemsTranslation', []) as $language => $data) {
        foreach ($data as $attribute => $translation) {
          $model->translate($language)->$attribute = $translation;
        }
      }

      if($model->save()) {
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


      foreach (Yii::$app->request->post('PaysystemsTranslation', []) as $language => $data) {
        foreach ($data as $attribute => $translation) {
          $model->translate($language)->$attribute = $translation;
        }
      }

      if($model->save()) {
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
        ->delete('paysystems_translation', ['paysystem_id' => $model->id])
        ->execute()) {
      }
    }

    return $this->redirect(['index']);
  }

  protected function findModel($id)
  {
    if (($model = Paysystems::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
  }
}
