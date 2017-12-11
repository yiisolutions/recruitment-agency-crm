<?php

use app\models\Currency;
use app\models\Employer;
use app\models\Language;
use app\models\Location;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Vacancy */
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

<div class="vacancy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'employer_id')->widget(Select2::className(), [
        'initValueText' => empty($model->employer_id) ? '' : Employer::findOne($model->employer_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('employer_id')],
        'pluginOptions' => ArrayHelper::merge($pluginOptions, [
            'ajax' => [
                'url' => Url::to(['/select2/employer']),
            ],
        ]),
    ]) ?>

    <?= $form->field($model, 'salary_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary_currency_id')->widget(Select2::className(), [
        'initValueText' => empty($model->salary_currency_id) ? '' : Currency::findOne($model->salary_currency_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('employer_id')],
        'pluginOptions' => ArrayHelper::merge($pluginOptions, [
            'ajax' => [
                'url' => Url::to(['/select2/currency']),
            ],
        ])
    ]) ?>

    <?= $form->field($model, 'language_id')->widget(Select2::className(), [
        'initValueText' => empty($model->language_id) ? '' : Language::findOne($model->language_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('language_id')],
        'pluginOptions' => ArrayHelper::merge($pluginOptions, [
            'ajax' => [
                'url' => Url::to(['/select2/language']),
            ],
        ])
    ]) ?>

    <?= $form->field($model, 'location_id')->widget(Select2::className(), [
        'initValueText' => empty($model->location_id) ? '' : Location::findOne($model->location_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('location_id')],
        'pluginOptions' => ArrayHelper::merge($pluginOptions, [
            'ajax' => [
                'url' => Url::to(['/select2/location']),
            ],
        ])
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
