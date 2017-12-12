<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Employer;
use yii\debug\Panel;

/**
 * EmployerSearch represents the model behind the search form about `app\models\Employer`.
 */
class EmployerSearch extends Employer implements SearchableInterface
{
    const SEARCH_FIELD_TITLE = 'title';
    const SEARCH_FIELD_DESCRIPTION = 'description';
    const SEARCH_FIELD_SITE_URL = 'site_url';

    public $search_text;
    public $search_fields = [
        self::SEARCH_FIELD_TITLE,
        self::SEARCH_FIELD_DESCRIPTION,
        self::SEARCH_FIELD_SITE_URL,
    ];
    public $created_at_range;
    public $updated_at_range;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],

            ['search_text', 'safe'],

            ['search_fields', 'each', 'rule' => [
                'in', 'range' => [
                    self::SEARCH_FIELD_TITLE,
                    self::SEARCH_FIELD_DESCRIPTION,
                    self::SEARCH_FIELD_SITE_URL,
                ],
            ]],

            ['created_at_range', 'safe'],

            ['updated_at_range', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function formName()
    {
        return '';
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
        $query = Employer::find();

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
        ]);

        if (!empty($this->created_at_range)) {
            list($from, $to) = explode(' - ', $this->created_at_range);

            if (!empty($from)) {
                $query->andFilterWhere(['>=', 'created_at', $from . ' 00:00:00']);
            }

            if (!empty($to)) {
                $query->andFilterWhere(['<=', 'created_at', $to . ' 23:59:59']);
            }
        }
        
        if (!empty($this->updated_at_range)) {
            list($from, $to) = explode(' - ', $this->updated_at_range);

            if (!empty($from)) {
                $query->andFilterWhere(['>=', 'updated_at', $from . ' 00:00:00']);
            }

            if (!empty($to)) {
                $query->andFilterWhere(['<=', 'updated_at', $to . ' 23:59:59']);
            }
        }

        if (!empty($this->search_text)) {
            Yii::trace('Init search text ' . $this->search_text, __CLASS__);

            $or = ['or'];

            if (in_array(self::SEARCH_FIELD_TITLE, $this->search_fields)) {
                $or[] = ['like', 'title', $this->search_text];
            }

            if (in_array(self::SEARCH_FIELD_DESCRIPTION, $this->search_fields)) {
                $or[] = ['like', 'description', $this->search_text];
            }

            if (in_array(self::SEARCH_FIELD_SITE_URL, $this->search_fields)) {
                $or[] = ['like', 'site_url', $this->search_text];
            }

            $query->andFilterWhere($or);
        }

        return $dataProvider;
    }
}
