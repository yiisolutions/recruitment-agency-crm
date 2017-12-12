<?php

use app\widgets\GridViewPanel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResumeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Resumes');

echo GridViewPanel::widget([
    'header' => $this->title,
    'permissionNamesMap' => [
        'view' => 'resume_read',
        'create' => 'resume_create',
        'update' => 'resume_update',
        'delete' => 'resume_delete',
    ],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'title',
        'description:ntext',
        'salary_from',
        'salary_to',
        'salary_amount',
        'salary_currency_id',
        'location_id',
        'applicant_id',
    ],
]);
