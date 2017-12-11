<?php

use app\models\Language;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$pluginOptions = [
    'allowClear' => true,
    'minimumInputLength' => false,
    'language' => [
        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
    ],
    'ajax' => [
        'url' => '',
        'dataType' => 'json',
        'data' => new JsExpression('function(params) { return {query: params.term}; }')
    ],
    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
    'templateResult' => new JsExpression('function(entity) { return entity.text; }'),
    'templateSelection' => new JsExpression('function (entity) { return entity.text; }'),
];

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->radioList([
        'manager' => Yii::t('app', 'Manager'),
        'admin' => Yii::t('app', 'Admin'),
    ]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'language_id')->widget(Select2::className(), [
        'initValueText' => empty($model->language_id) ? '' : Language::findOne($model->language_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('language_id')],
        'pluginOptions' => ArrayHelper::merge($pluginOptions, [
            'ajax' => [
                'url' => Url::to(['/select2/language']),
            ],
        ]),
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
