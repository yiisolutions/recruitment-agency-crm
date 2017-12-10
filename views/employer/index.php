<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Employers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php

        $user = Yii::$app->getUser();

        if ($user->can('employer_create')) {
            echo Html::a(Yii::t('app', 'Create Employer'), ['create'], ['class' => 'btn btn-success']);
        }

        ?>
    </p>
    <?= GridView::widget([
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
                'visibleButtons' => [
                    'view' => $user->can('employer_read'),
                    'update' => $user->can('employer_update'),
                    'delete' => $user->can('employer_delete'),
                ]
            ],
        ],
    ]); ?>
</div>
