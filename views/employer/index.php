<?php

use app\widgets\GridViewPanel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Employers');

?>

<div class="col-sm-3">
    <?= $this->render('_search.php', [
        'model' => $searchModel,
    ]) ?>
</div>
<div class="col-sm-9">
    <?= GridViewPanel::widget([
        'header' => $this->title,
        'permissionNamesMap' => [
            'view' => 'employer_read',
            'create' => 'employer_create',
            'update' => 'employer_update',
            'delete' => 'employer_delete',
        ],
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            'description:ntext',
            'site_url:url',
            'created_at:datetime',
            'updated_at:datetime',
        ]
    ]) ?>
</div>
