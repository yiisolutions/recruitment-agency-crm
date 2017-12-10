<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login Form');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="animate form login_form">
    <section class="login_content">
        <?php $form = ActiveForm::begin(); ?>
            <h1><?= Html::encode($this->title) ?></h1>

            <?= $form->field($model, 'username')->label(false)->textInput([
                'autofocus' => true,
                'placeholder' => $model->getAttributeLabel('username'),
            ]) ?>

            <?= $form->field($model, 'password')->label(false)->passwordInput([
                'placeholder' => $model->getAttributeLabel('password'),
            ]) ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-default submit', 'name' => 'login-button']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </section>
</div>
