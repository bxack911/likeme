<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Strings;
use common\models\StringsTranslation;
use backend\behaviors\TranslateableBehavior;


/**
 * PagesSearch represents the model behind the search form about `common\models\Pages`.
 */
class StringsSearch extends Strings
{
  public $str_key;
  public $value;

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['id'], 'integer'],
      [['str_key', 'value'], 'safe'],
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
    $query = Strings::find();

    $query->joinWith('translations');

    // add conditions that should always apply here
    $dataProvider = new ActiveDataProvider([
      'query' => $query->distinct(),
      'pagination' => [
        'pagesize' => Yii::$app->params['pagesize'],
      ],
    ]);

    $dataProvider->sort->attributes['title'] = [
      'asc' => [StringsTranslation::tableName() . '.key' => SORT_ASC],
      'desc' => [StringsTranslation::tableName() . '.key' => SORT_DESC],
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

    $query->andFilterWhere(['like', StringsTranslation::tableName() . '.str_key', $this->str_key]);

    return $dataProvider;
  }
}
