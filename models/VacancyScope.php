<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%vacancy_scope}}".
 *
 * @property integer $vacancy_id
 * @property integer $scope_id
 *
 * @property Scope $scope
 * @property Vacancy $vacancy
 */
class VacancyScope extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vacancy_scope}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vacancy_id', 'scope_id'], 'required'],
            [['vacancy_id', 'scope_id'], 'integer'],
            [['scope_id'], 'exist', 'skipOnError' => true, 'targetClass' => Scope::className(), 'targetAttribute' => ['scope_id' => 'id']],
            [['vacancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vacancy::className(), 'targetAttribute' => ['vacancy_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vacancy_id' => Yii::t('app', 'Vacancy ID'),
            'scope_id' => Yii::t('app', 'Scope ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScope()
    {
        return $this->hasOne(Scope::className(), ['id' => 'scope_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancy()
    {
        return $this->hasOne(Vacancy::className(), ['id' => 'vacancy_id']);
    }
}
