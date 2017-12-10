<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CurrencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Currencies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php

        $user = Yii::$app->getUser();

        if ($user->can('currency_create')) {
            echo Html::a(Yii::t('app', 'Create Currency'), ['create'], ['class' => 'btn btn-success']);
        }

        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            'iso4217',
            'created_at:datetime',
            'updated_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => $user->can('currency_read'),
                    'update' => $user->can('currency_update'),
                    'delete' => $user->can('currency_delete'),
                ],
            ],
        ],
    ]); ?>
</div>
