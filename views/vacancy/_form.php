<?php

use app\models\Currency;
use app\models\Employer;
use app\models\Language;
use app\models\Location;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\AjaxDropDownWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Vacancy */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="vacancy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'employer_id')->widget(AjaxDropDownWidget::className(), [
        'initValueText' => empty($model->employer_id) ? '' : Employer::findOne($model->employer_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('employer_id')],
        'action' => 'employer',
    ]) ?>

    <?= $form->field($model, 'salary_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary_currency_id')->widget(AjaxDropDownWidget::className(), [
        'initValueText' => empty($model->salary_currency_id) ? '' : Currency::findOne($model->salary_currency_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('employer_id')],
        'action' => 'currency',
    ]) ?>

    <?= $form->field($model, 'language_id')->widget(AjaxDropDownWidget::className(), [
        'initValueText' => empty($model->language_id) ? '' : Language::findOne($model->language_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('language_id')],
        'action' => 'language',
    ]) ?>

    <?= $form->field($model, 'location_id')->widget(AjaxDropDownWidget::className(), [
        'initValueText' => empty($model->location_id) ? '' : Location::findOne($model->location_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('location_id')],
        'action' => 'location',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
