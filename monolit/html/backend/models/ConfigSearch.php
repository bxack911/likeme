<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Config;


/**
 * PagesSearch represents the model behind the search form about `common\models\Pages`.
 */
class ConfigSearch extends Config
{
    public $title;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','code'], 'safe'],
        ];
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
        $query = Config::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query->distinct(),
            'pagination' => [
                'pagesize' => Yii::$app->params['pagesize'],
            ],
        ]);

        $dataProvider->sort->attributes['key'] = [
            'asc' => [Config::tableName() . '.key' => SORT_ASC],
            'desc' => [Config::tableName() . '.key' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'key' => $this->key,
        ]);

        $query->andFilterWhere(['like', 'key', $this->key]);

        return $dataProvider;
    }
}