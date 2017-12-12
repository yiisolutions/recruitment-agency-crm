<?php

use app\widgets\GridViewPanel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ScopeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Scopes');

echo GridViewPanel::widget([
    'header' => $this->title,
    'permissionNamesMap' => [
        'view' => 'scope_read',
        'create' => 'scope_create',
        'update' => 'scope_update',
        'delete' => 'scope_delete',
    ],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'title',
        'description:ntext',
        'parent_id',
        'created_at:datetime',
        'updated_at:datetime',
    ],
]);
