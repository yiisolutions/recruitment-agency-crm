<?php

use app\widgets\GridViewPanel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LanguageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Languages');

echo GridViewPanel::widget([
    'header' => $this->title,
    'permissionNamesMap' => [
        'view' => 'language_read',
        'create' => 'language_create',
        'update' => 'language_update',
        'delete' => 'language_delete',
    ],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'title',
        'code',
        'created_at:datetime',
        'updated_at:datetime',
    ],
]);
