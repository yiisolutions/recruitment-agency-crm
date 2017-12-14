<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%applicant}}".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property integer $age
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Resume[] $resumes
 */
class Applicant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%applicant}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['first_name', 'required'],
            ['first_name', 'string', 'max' => 255],

            ['last_name', 'required'],
            ['last_name', 'string', 'max' => 255],

            ['age', 'integer'],

            ['email', 'string'],
            ['email', 'email'],

            ['phone', 'string', 'max' => 32],
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'age' => Yii::t('app', 'Age'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resume::className(), ['applicant_id' => 'id']);
    }

    public function __toString()
    {
        return implode(' ', [
            $this->first_name,
            $this->last_name,
        ]);
    }
}
