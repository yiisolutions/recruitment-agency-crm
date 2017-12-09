<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Employer */

$this->title = Yii::t('app', 'Create Employer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
