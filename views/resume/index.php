<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResumeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Resumes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php

        $user = Yii::$app->getUser();

        if ($user->can('resume_create')) {
            echo Html::a(Yii::t('app', 'Create resume'), ['create'], ['class' => 'btn btn-success']);
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
            'salary_from',
            'salary_to',
            // 'salary_amount',
            // 'salary_resume_id',
            // 'location_id',
            // 'applicant_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => $user->can('resume_read'),
                    'update' => $user->can('resume_update'),
                    'delete' => $user->can('resume_delete'),
                ],
            ],
        ],
    ]); ?>
</div>
