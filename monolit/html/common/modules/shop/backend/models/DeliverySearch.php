<?php

namespace common\modules\shop\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\shop\common\models\addons\Delivery;
use common\modules\shop\common\models\addons\DeliveryTranslation;
use backend\behaviors\TranslateableBehavior;

class DeliverySearch extends Delivery
{
  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['id', 'sum'], 'integer'],
      [['name', 'comment'], 'safe'],
      [['status'], 'boolean']
    ];
  }


  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    $behaviors = parent::behaviors();

    $behaviors['translateable']['class'] = TranslateableBehavior::className();

    return $behaviors;
  }

  /**
   * @inheritdoc
   */
  public function scenarios()
  {
    // bypass scenarios() implementation in the parent class
    return Model::scenarios();
  }

  /**
   * Creates data provider instance with search query applied
   *
   * @param array $params
   *
   * @return ActiveDataProvider
   */
  public function search($params)
  {
    $query = Delivery::find();

    $query->joinWith('translations');

    // add conditions that should always apply here
    $dataProvider = new ActiveDataProvider([
      'query' => $query->distinct(),
      'pagination' => [
        'pagesize' => Yii::$app->params['pagesize'],
      ],
    ]);

    $dataProvider->sort->attributes['name'] = [
      'asc' => [DeliveryTranslation::tableName() . '.name' => SORT_ASC],
      'desc' => [DeliveryTranslation::tableName() . '.name' => SORT_DESC],
    ];

    $this->load($params);

    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    // grid filtering conditions
    $query->andFilterWhere([
      'id' => $this->id,
    ]);

    $query->andFilterWhere(['like', DeliveryTranslation::tableName() . '.name', $this->name]);

    return $dataProvider;
  }
}
