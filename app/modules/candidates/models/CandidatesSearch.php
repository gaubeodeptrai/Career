<?php

namespace app\modules\candidates\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\candidates\models\Candidates;

/**
 * CandidatesSearch represents the model behind the search form of `app\models\Candidates`.
 */
class CandidatesSearch extends Candidates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['candidate_id','status', 'age'], 'integer'],
            [['fullname', 'education_level', 'expected_salary'], 'string'],
            [['category_id'], 'safe'],
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
        $query = Candidates::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        };
        
        $query->joinWith('category');

        // grid filtering conditions
        $query->andFilterWhere([
            'candidate_id' => $this->candidate_id,
            'age' => $this->age,
            'candidates.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'candidates.fullname', $this->fullname])
            ->andFilterWhere(['like', 'easyii_catalog_categories.title', $this->category_id])
            ->andfilterWhere(['like', 'expected_salary', $this->expected_salary]);
        return $dataProvider;
    }
}
