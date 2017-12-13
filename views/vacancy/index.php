<?php

use app\widgets\GridViewPanel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VacancySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vacancies');

echo GridViewPanel::widget([
    'header' => $this->title,
    'permissionNamesMap' => [
        'view' => 'vacancy_read',
        'create' => 'vacancy_create',
        'update' => 'vacancy_update',
        'delete' => 'vacancy_delete',
    ],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'title',
        'employer_id',
        'salary_from',
        'salary_to',
        'salary_amount',
        'salary_currency_id',
        'location_id',
    ],
]);
