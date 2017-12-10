<?php

use yiister\gentelella\widgets\grid\GridView;
use yiister\gentelella\widgets\Panel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VacancySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$user = Yii::$app->getUser();

$this->title = Yii::t('app', 'Vacancies');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php Panel::begin([
    'header' => $this->title,
    'collapsable' => true,
    'tools' => [
        ['label' => '<i class="fa fa-plus text-success"></i>', 'encode' => false, 'url' => ['/vacancy/create'], 'visible' => $user->can('vacancy_create')],
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
        'employer_id',
        'salary_from',
        'salary_to',
        'salary_amount',
        'salary_currency_id',
        'location_id',

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('app', 'Actions'),
            'visibleButtons' => [
                'view' => $user->can('vacancy_read'),
                'update' => $user->can('vacancy_update'),
                'delete' => $user->can('vacancy_delete'),
            ],
        ],
    ],
]); ?>

<?php Panel::end() ?>
