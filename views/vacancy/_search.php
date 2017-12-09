<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VacancySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacancy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'employer_id') ?>

    <?= $form->field($model, 'salary_from') ?>

    <?php // echo $form->field($model, 'salary_to') ?>

    <?php // echo $form->field($model, 'salary_amount') ?>

    <?php // echo $form->field($model, 'salary_currency_id') ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
