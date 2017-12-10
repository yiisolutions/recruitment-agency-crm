<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ScopeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Scopes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scope-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php

        $user = Yii::$app->getUser();

        if ($user->can('scope_create')) {
            echo Html::a(Yii::t('app', 'Create scope'), ['create'], ['class' => 'btn btn-success']);
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
            'parent_id',
            'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => $user->can('scope_read'),
                    'update' => $user->can('scope_update'),
                    'delete' => $user->can('scope_delete'),
                ],
            ],
        ],
    ]); ?>
</div>
