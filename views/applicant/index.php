<?php

use yiister\gentelella\widgets\grid\GridView;
use yiister\gentelella\widgets\Panel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$user = Yii::$app->getUser();

$this->title = Yii::t('app', 'Applicants');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Panel::begin([
    'header' => $this->title,
    'collapsable' => true,
    'tools' => [
        ['label' => '<i class="fa fa-plus text-success"></i>', 'encode' => false, 'url' => ['/applicant/create'], 'visible' => $user->can('applicant_create')],
    ],
]) ?>

<?= GridView::widget([
    'bordered' => false,
    'hover' => true,
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

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('app', 'Actions'),
            'visibleButtons' => [
                'view' => $user->can('applicant_read'),
                'update' => $user->can('applicant_update'),
                'delete' => $user->can('applicant_delete'),
            ],
        ],
    ],
]); ?>

<?php Panel::end() ?>