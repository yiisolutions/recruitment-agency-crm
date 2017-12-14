<?php

namespace app\models;

use bedezign\yii2\audit\AuditTrailBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%resume}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $salary_from
 * @property string $salary_to
 * @property string $salary_amount
 * @property integer $salary_currency_id
 * @property integer $location_id
 * @property integer $applicant_id
 * @property integer $language_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Applicant $applicant
 * @property Location $location
 * @property Currency $salaryCurrency
 * @property ResumeScope[] $resumeScopes
 * @property Scope[] $scopes
 * @property ResumeSkill[] $resumeSkills
 * @property Skill[] $skills
 * @property Language $language
 */
class Resume extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%resume}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['salary_from', 'salary_to', 'salary_amount'], 'number'],
            [['salary_currency_id', 'location_id', 'applicant_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['applicant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Applicant::className(), 'targetAttribute' => ['applicant_id' => 'id']],
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
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => AuditTrailBehavior::className(),
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
            'salary_from' => Yii::t('app', 'Salary From'),
            'salary_to' => Yii::t('app', 'Salary To'),
            'salary_amount' => Yii::t('app', 'Salary Amount'),
            'salary_currency_id' => Yii::t('app', 'Salary Currency ID'),
            'location_id' => Yii::t('app', 'Location ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'applicant_id' => Yii::t('app', 'Applicant ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplicant()
    {
        return $this->hasOne(Applicant::className(), ['id' => 'applicant_id']);
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
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
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
    public function getResumeScopes()
    {
        return $this->hasMany(ResumeScope::className(), ['resume_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScopes()
    {
        return $this->hasMany(Scope::className(), ['id' => 'scope_id'])->viaTable('{{%resume_scope}}', ['resume_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumeSkills()
    {
        return $this->hasMany(ResumeSkill::className(), ['resume_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['id' => 'skill_id'])->viaTable('{{%resume_skill}}', ['resume_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->title;
    }
}
