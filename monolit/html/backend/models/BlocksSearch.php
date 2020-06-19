<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Blocks;
use common\models\BlocksTranslation;
use backend\behaviors\TranslateableBehavior;


/**
 * PagesSearch represents the model behind the search form about `common\models\Pages`.
 */
class BlocksSearch extends Blocks
{
    public $title;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'value'], 'safe'],
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
        $query = Blocks::find();

        $query->joinWith('translations');

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query->distinct(),
            'pagination' => [
                'pagesize' => Yii::$app->params['pagesize'],
            ],
        ]);

        $dataProvider->sort->attributes['title'] = [
            'asc' => [BlocksTranslation::tableName() . '.value' => SORT_ASC],
            'desc' => [BlocksTranslation::tableName() . '.value' => SORT_DESC],
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

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', BlocksTranslation::tableName() . '.value', $this->value]);

        return $dataProvider;
    }
}