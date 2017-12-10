<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VacancySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vacancies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php

        $user = Yii::$app->getUser();

        if ($user->can('vacancy_create')) {
            echo Html::a(Yii::t('app', 'Create vacancy'), ['create'], ['class' => 'btn btn-success']);
        }

        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            'employer_id',
            'salary_from',
            // 'salary_to',
            // 'salary_amount',
            // 'salary_vacancy_id',
            // 'location_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => $user->can('vacancy_read'),
                    'update' => $user->can('vacancy_update'),
                    'delete' => $user->can('vacancy_delete'),
                ],
            ],
        ],
    ]); ?>
</div>
