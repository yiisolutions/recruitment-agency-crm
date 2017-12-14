<?php

namespace app\models;

use app\models\events\SearchEvent;
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
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors[] = [
            'class' => 'app\models\behaviors\FilterSearchText',
            'searchableFields' => [
                self::SEARCH_FIELD_TITLE,
                self::SEARCH_FIELD_DESCRIPTION,
                self::SEARCH_FIELD_SITE_URL,
            ],
        ];

        $behaviors[] = [
            'class' => 'app\models\behaviors\FilterTimestampRange',
            'dbAttribute' => 'created_at',
        ];

        $behaviors[] = [
            'class' => 'app\models\behaviors\FilterTimestampRange',
            'dbAttribute' => 'updated_at',
        ];


        return $behaviors;
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

        $this->trigger(SearchableInterface::EVENT_BEFORE_SEARCH, new SearchEvent(['query' => $query]));

        return $dataProvider;
    }
}
