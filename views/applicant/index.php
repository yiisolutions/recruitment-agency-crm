<?php

use app\widgets\GridViewPanel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ApplicantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Applicants');

?>

<div class="row">
    <div class="col-sm-3">
        <?= $this->render('_search.php', [
            'model' => $searchModel,
        ]) ?>
    </div>

    <div class="col-sm-9">
        <?= GridViewPanel::widget([
            'header' => $this->title,
            'permissionNamesMap' => [
                'view' => 'applicant_read',
                'create' => 'applicant_create',
                'update' => 'applicant_update',
                'delete' => 'applicant_delete',
            ],
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'first_name',
                'last_name',
                'phone',
                'email:email',
                'age',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>