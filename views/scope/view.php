<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Scope */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Scopes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scope-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php

        $user = Yii::$app->getUser();

        if ($user->can('scope_update')) {
            echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }

        if ($user->can('scope_delete')) {
            echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
        }

        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'parent_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
