<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Skill */

$this->title = Yii::t('app', 'Create Skill');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Skills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skill-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
