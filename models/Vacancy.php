<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%vacancy}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $employer_id
 * @property string $salary_from
 * @property string $salary_to
 * @property string $salary_amount
 * @property integer $salary_currency_id
 * @property integer $location_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Employer $employer
 * @property Location $location
 * @property Currency $salaryCurrency
 * @property VacancyScope[] $vacancyScopes
 * @property Scope[] $scopes
 * @property VacancySkill[] $vacancySkills
 * @property Skill[] $skills
 */
class Vacancy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vacancy}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'employer_id'], 'required'],
            [['description'], 'string'],
            [['employer_id', 'salary_currency_id', 'location_id'], 'integer'],
            [['salary_from', 'salary_to', 'salary_amount'], 'number'],
            [['title'], 'string', 'max' => 255],
            [['employer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employer::className(), 'targetAttribute' => ['employer_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['location_id' => 'id']],
            [['salary_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['salary_currency_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'employer_id' => Yii::t('app', 'Employer ID'),
            'salary_from' => Yii::t('app', 'Salary From'),
            'salary_to' => Yii::t('app', 'Salary To'),
            'salary_amount' => Yii::t('app', 'Salary Amount'),
            'salary_currency_id' => Yii::t('app', 'Salary Currency ID'),
            'location_id' => Yii::t('app', 'Location ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployer()
    {
        return $this->hasOne(Employer::className(), ['id' => 'employer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalaryCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'salary_currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancyScopes()
    {
        return $this->hasMany(VacancyScope::className(), ['vacancy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScopes()
    {
        return $this->hasMany(Scope::className(), ['id' => 'scope_id'])->viaTable('{{%vacancy_scope}}', ['vacancy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancySkills()
    {
        return $this->hasMany(VacancySkill::className(), ['vacancy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['id' => 'skill_id'])->viaTable('{{%vacancy_skill}}', ['vacancy_id' => 'id']);
    }
}
