<?php

use app\models\Applicant;
use app\models\Currency;
use app\models\Location;
use app\widgets\AjaxDropDownWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resume-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'salary_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary_currency_id')->widget(AjaxDropDownWidget::className(), [
        'initValueText' => empty($model->salary_currency_id) ? '' : Currency::findOne($model->salary_currency_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('salary_currency_id')],
        'action' => 'currency',
    ]) ?>

    <?= $form->field($model, 'location_id')->widget(AjaxDropDownWidget::className(), [
        'initValueText' => empty($model->location_id) ? '' : Location::findOne($model->location_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('location_id')],
        'action' => 'location',
    ]) ?>

    <?= $form->field($model, 'applicant_id')->widget(AjaxDropDownWidget::className(), [
        'initValueText' => empty($model->applicant_id) ? '' : Applicant::findOne($model->applicant_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('applicant_id')],
        'action' => 'applicant',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
