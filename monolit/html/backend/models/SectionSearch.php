<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Section;
use common\models\SectionTranslation;
use backend\behaviors\TranslateableBehavior;


/**
 * PagesSearch represents the model behind the search form about `common\models\Pages`.
 */
class SectionSearch extends Section
{
    public $title;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['slug', 'title'], 'safe'],
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
        $query = Section::find();

        $query->joinWith('translations');

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query->distinct(),
            'pagination' => [
                'pagesize' => Yii::$app->params['pagesize'],
            ],
        ]);

        $dataProvider->sort->attributes['title'] = [
            'asc' => [SectionTranslation::tableName() . '.title' => SORT_ASC],
            'desc' => [SectionTranslation::tableName() . '.title' => SORT_DESC],
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

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', SectionTranslation::tableName() . '.title', $this->title]);

        return $dataProvider;
    }
}