<?php

use app\widgets\GridViewPanel;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');

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
                'view' => 'user_read',
                'create' => 'user_create',
                'update' => 'user_update',
                'delete' => 'user_delete',
            ],
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                'first_name',
                'last_name',
                'role',
                'username',
                'email:email',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>

