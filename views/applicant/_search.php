<?php

use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yiister\gentelella\widgets\Panel;

/* @var $this yii\web\View */
/* @var $model app\models\ApplicantSearch */
/* @var $form yii\widgets\ActiveForm */
?>


<?php Panel::begin([
    'header' => Yii::t('app', 'Filters'),
]) ?>

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>

<?= $form->field($model, 'id')->textInput(['type' => 'number']) ?>

<?= $form->field($model, 'search_text')->textInput() ?>

<?= $form->field($model, 'search_fields')->checkboxList([
    'first_name' => $model->getAttributeLabel('first_name'),
    'last_name' => $model->getAttributeLabel('last_name'),
    'email' => $model->getAttributeLabel('email'),
    'phone' => $model->getAttributeLabel('phone'),
]) ?>

<?= $form->field($model, 'age')->textInput(['type' => 'number']) ?>

<?= $form->field($model, 'created_at_range')->widget(DateRangePicker::className(), [
    'options' => [
        'class' => 'form-control',
        'onchange' => 'this.form.submit()',
    ],
    'pluginOptions' => [
        'drops' => 'up',
        'locale' => ['format' => 'YYYY-MM-DD'],
    ],
]) ?>

<?= $form->field($model, 'updated_at_range')->widget(DateRangePicker::className(), [
    'options' => [
        'class' => 'form-control',
        'onchange' => 'this.form.submit()',
    ],
    'pluginOptions' => [
        'drops' => 'up',
        'locale' => ['format' => 'YYYY-MM-DD'],
    ],
]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), ['index'], ['class' => 'btn btn-default']) ?>
    </div>

<?php ActiveForm::end(); ?>

<?php Panel::end() ?>