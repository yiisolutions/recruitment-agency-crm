<?php

use app\widgets\GridViewPanel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SkillSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Skills');

echo GridViewPanel::widget([
    'header' => $this->title,
    'permissionNamesMap' => [
        'view' => 'skill_read',
        'create' => 'skill_create',
        'update' => 'skill_update',
        'delete' => 'skill_delete',
    ],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [

        'id',
        'title',
        'created_at:datetime',
        'updated_at:datetime',
    ],
]);
