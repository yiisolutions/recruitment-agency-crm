<?php

use app\widgets\GridViewPanel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Applicants');

echo GridViewPanel::widget([
    'header' => $this->title,
    'permissionNamesMap' => [
        'view' => 'applicant_read',
        'create' => 'applicant_create',
        'update' => 'applicant_update',
        'delete' => 'applicant_delete',
    ],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'first_name',
        'last_name',
        'phone',
        'email:email',
        'age',
        'created_at:datetime',
        'updated_at:datetime',
    ],
]);