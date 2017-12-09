<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Resume;

/**
 * ResumeSearch represents the model behind the search form about `app\models\Resume`.
 */
class ResumeSearch extends Resume
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'salary_currency_id', 'location_id', 'applicant_id'], 'integer'],
            [['title', 'description'], 'safe'],
            [['salary_from', 'salary_to', 'salary_amount'], 'number'],
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
        $query = Resume::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'salary_from' => $this->salary_from,
            'salary_to' => $this->salary_to,
            'salary_amount' => $this->salary_amount,
            'salary_currency_id' => $this->salary_currency_id,
            'location_id' => $this->location_id,
            'applicant_id' => $this->applicant_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
