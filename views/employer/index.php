<?php

use yiister\gentelella\widgets\grid\GridView;
use yiister\gentelella\widgets\Panel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$user = Yii::$app->getUser();

$this->title = Yii::t('app', 'Employers');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Panel::begin([
    'header' => $this->title,
    'collapsable' => true,
    'tools' => [
        ['label' => '<i class="fa fa-plus text-success"></i>', 'encode' => false, 'url' => ['/employer/create'], 'visible' => $user->can('employer_create')],
    ],
]) ?>

<?= GridView::widget([
    'bordered' => false,
    'hover' => true,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [

        'id',
        'title',
        'description:ntext',
        'site_url:url',
        'created_at:datetime',
        'updated_at:datetime',

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('app', 'Actions'),
            'visibleButtons' => [
                'view' => $user->can('employer_read'),
                'update' => $user->can('employer_update'),
                'delete' => $user->can('employer_delete'),
            ]
        ],
    ],
]); ?>

<?php Panel::end() ?>

