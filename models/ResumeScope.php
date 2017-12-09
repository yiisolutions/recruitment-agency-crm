<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%resume_scope}}".
 *
 * @property integer $resume_id
 * @property integer $scope_id
 *
 * @property Resume $resume
 * @property Scope $scope
 */
class ResumeScope extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%resume_scope}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['resume_id', 'scope_id'], 'required'],
            [['resume_id', 'scope_id'], 'integer'],
            [['resume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resume::className(), 'targetAttribute' => ['resume_id' => 'id']],
            [['scope_id'], 'exist', 'skipOnError' => true, 'targetClass' => Scope::className(), 'targetAttribute' => ['scope_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'resume_id' => Yii::t('app', 'Resume ID'),
            'scope_id' => Yii::t('app', 'Scope ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResume()
    {
        return $this->hasOne(Resume::className(), ['id' => 'resume_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScope()
    {
        return $this->hasOne(Scope::className(), ['id' => 'scope_id']);
    }
}
