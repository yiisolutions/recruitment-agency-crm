<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Applicant */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Applicant',
]) . (string)$model;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Applicants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="applicant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
