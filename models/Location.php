<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%location}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $level
 * @property integer $parent_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Location $parent
 * @property Location[] $locations
 * @property Resume[] $resumes
 * @property Vacancy[] $vacancies
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'created_at', 'updated_at'], 'required'],
            [['level', 'parent_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'level' => Yii::t('app', 'Level'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Location::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resume::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancies()
    {
        return $this->hasMany(Vacancy::className(), ['location_id' => 'id']);
    }
}
