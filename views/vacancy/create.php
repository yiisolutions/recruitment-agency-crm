<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vacancy */

$this->title = Yii::t('app', 'Create Vacancy');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vacancies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
