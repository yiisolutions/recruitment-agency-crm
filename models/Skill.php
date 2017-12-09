<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%skill}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ResumeSkill[] $resumeSkills
 * @property Resume[] $resumes
 * @property VacancySkill[] $vacancySkills
 * @property Vacancy[] $vacancies
 */
class Skill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%skill}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'created_at', 'updated_at'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumeSkills()
    {
        return $this->hasMany(ResumeSkill::className(), ['skill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resume::className(), ['id' => 'resume_id'])->viaTable('{{%resume_skill}}', ['skill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancySkills()
    {
        return $this->hasMany(VacancySkill::className(), ['skill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancies()
    {
        return $this->hasMany(Vacancy::className(), ['id' => 'vacancy_id'])->viaTable('{{%vacancy_skill}}', ['skill_id' => 'id']);
    }
}
