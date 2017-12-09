<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Scope */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Scope',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Scopes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="scope-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
