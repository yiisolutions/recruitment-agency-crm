<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Scope */

$this->title = Yii::t('app', 'Create Scope');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Scopes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scope-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
