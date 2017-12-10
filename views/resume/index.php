<?php

use yiister\gentelella\widgets\grid\GridView;
use yiister\gentelella\widgets\Panel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResumeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$user = Yii::$app->getUser();

$this->title = Yii::t('app', 'Resumes');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Panel::begin([
    'header' => $this->title,
    'collapsable' => true,
    'tools' => [
        ['label' => '<i class="fa fa-plus text-success"></i>', 'encode' => false, 'url' => ['/resume/create'], 'visible' => $user->can('resume_create')],
    ],
]) ?>

<?= GridView::widget([
    'bordered' => false,
    'hover' => true,
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'title',
        'description:ntext',
        'salary_from',
        'salary_to',
        'salary_amount',
        'salary_resume_id',
        'location_id',
        'applicant_id',

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('app', 'Actions'),
            'visibleButtons' => [
                'view' => $user->can('resume_read'),
                'update' => $user->can('resume_update'),
                'delete' => $user->can('resume_delete'),
            ],
        ],
    ],
]); ?>

<?php Panel::end() ?>
