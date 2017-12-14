<?php

namespace app\models;

use app\models\events\SearchEvent;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * ApplicantSearch represents the model behind the search form about `app\models\Applicant`.
 */
class ApplicantSearch extends Applicant implements SearchableInterface
{
    const SEARCH_FIELD_FIRST_NAME = 'first_name';
    const SEARCH_FIELD_LAST_NAME = 'last_name';
    const SEARCH_FIELD_EMAIL = 'email';
    const SEARCH_FIELD_PHONE = 'phone';

    public $search_text;
    public $search_fields = [
        self::SEARCH_FIELD_FIRST_NAME,
        self::SEARCH_FIELD_LAST_NAME,
        self::SEARCH_FIELD_EMAIL,
        self::SEARCH_FIELD_PHONE,
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

            ['age', 'integer'],

            ['search_text', 'safe'],

            ['search_fields', 'each', 'rule' => [
                'in', 'range' => [
                    self::SEARCH_FIELD_FIRST_NAME,
                    self::SEARCH_FIELD_LAST_NAME,
                    self::SEARCH_FIELD_EMAIL,
                    self::SEARCH_FIELD_PHONE,
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
                self::SEARCH_FIELD_FIRST_NAME,
                self::SEARCH_FIELD_LAST_NAME,
                self::SEARCH_FIELD_EMAIL,
                self::SEARCH_FIELD_PHONE,
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
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'search_text' => Yii::t('app', 'Search Text'),
            'search_fields' => Yii::t('app', 'Search Fields'),
            'created_at_range' => Yii::t('app', 'Created At Range'),
            'updated_at_range' => Yii::t('app', 'Updated At Range'),
        ]);
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
        $query = Applicant::find();

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
            'age' => $this->age,
        ]);

        $this->trigger(SearchableInterface::EVENT_BEFORE_SEARCH, new SearchEvent(['query' => $query]));

        return $dataProvider;
    }
}
