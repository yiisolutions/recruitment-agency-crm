<?php
/**
 * Left column in main layout.
 */

use app\models\User as UserModel;
use app\widgets\LanguageSelector;
use app\widgets\SidebarMenu;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\User;
use yii\web\View;

/** @var View $this */
/** @var string $brand */
/** @var string|array $brandUrl */
/** @var User $user */
/** @var UserModel|ActiveRecord $userModel */
?>

<div class="left_col scroll-view">

    <!-- navbar brand -->
    <div class="navbar nav_title" style="border: 0;">
        <a href="<?= Url::to($brandUrl) ?>" class="site_title">
            <i class="fa fa-briefcase"></i>
            <span><?= Html::encode($brand) ?></span>
        </a>
    </div>
    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile">
        <div class="profile_pic">
            <img src="http://placehold.it/128x128" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span><?= Yii::t('app', 'Welcome') ?>,</span>
            <h2><?= Html::encode($userModel) ?></h2>
        </div>
    </div>
    <div class="clearfix"></div>

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3><?= Yii::t('app', 'General') ?></h3>
            <?= SidebarMenu::widget([
                'user' => $user,
            ]) ?>
        </div>
        <div class="clearfix"></div>

        <div class="menu_section">
            <h3><?= Yii::t('app', 'Language') ?></h3>
            <?= LanguageSelector::widget([
                'ajaxDropDownOptions' => [
                    'action' => 'language',
                    'allowClear' => false,
                ],
            ]) ?>
        </div>
    </div>
</div>
