<?php
namespace common\modules\shop\backend\controllers;

use common\helpers\FileHelper;
use http\Env\Response;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\modules\shop\backend\models\ProductsSearch;
use common\modules\shop\common\models\Products;
use common\models\ImageValidate;

/**
 * Site controller
 */
class ProductsController extends Controller
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
            'actions' => ['index','create','delete','update','galleryApi'],
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
      'galleryApi' => [
        'class' => \zxbodya\yii2\galleryManager\GalleryManagerAction::className(),
        // mappings between type names and model classes (should be the same as in behaviour)
        'types' => [
          'products' => Products::className()
        ]
      ],
    ];
  }

  public function actionIndex()
  {
    $searchModel = new ProductsSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionCreate()
  {
    $model = new Products();
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {

      $data = Yii::$app->request->post();

      if($image = $data['Products']['image']){
        $model->image = $data['Products']['image'];
      }

      foreach (Yii::$app->request->post('ProductsTranslation', []) as $language => $data) {
        foreach ($data as $attribute => $translation) {
          $model->translate($language)->$attribute = $translation;
        }
      }

      if($model->save()) {
        Yii::$app->session->setFlash('success', Yii::t('backend/products', 'Product "{item}" successfully created', ['item' => $model->translate(Yii::$app->config->get('pagesLanguage'))->title]));
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

      if($image = $data['Products']['image']){
        $model->image = $data['Products']['image'];
      }

      foreach (Yii::$app->request->post('ProductsTranslation', []) as $language => $data) {
        foreach ($data as $attribute => $translation) {
          $model->translate($language)->$attribute = $translation;
        }
      }

      if($model->save()) {
        Yii::$app->session->setFlash('success', Yii::t('backend/products', 'Product "{item}" successfully updated', ['item' => $model->translate(Yii::$app->config->get('pagesLanguage'))->title]));
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
        ->delete('products_translation', ['product_id' => $model->id])
        ->execute()) {
        Yii::$app->session->setFlash('success', Yii::t('backend/products', 'Product "{item}" successfully deleted', ['item' => $model->translate(Yii::$app->config->get('pagesLanguage'))->title]));
      }
    }

    return $this->redirect(['index']);
  }

  protected function findModel($id)
  {
    if (($model = Products::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
  }
}
