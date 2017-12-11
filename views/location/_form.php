<?php

use app\models\Location;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Location */
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

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'parent_id')->widget(Select2::className(), [
        'initValueText' => empty($model->parent_id) ? '' : Location::findOne($model->parent_id)->title,
        'options' => ['placeholder' => $model->getAttributeLabel('parent_id')],
        'pluginOptions' => ArrayHelper::merge($pluginOptions, [
            'ajax' => [
                'url' => Url::to(['/select2/location']),
            ],
        ]),
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
