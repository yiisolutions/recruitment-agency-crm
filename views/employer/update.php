<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Employer */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Employer',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="employer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
