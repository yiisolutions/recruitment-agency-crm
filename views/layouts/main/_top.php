<?php
/**
 * Top navigation for main layout.
 */

use app\models\User as UserModel;
use yii\helpers\Url;
use yii\web\View;

/** @var View $this */
/** @var UserModel $userModel */
/** @var string|array $logoutUrl */
/** @var string|array $profileUrl */
?>

<div class="top_nav">
    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="http://placehold.it/128x128" alt=""><?= $userModel ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?= Url::to($profileUrl) ?>">  <?= Yii::t('app', 'Profile') ?></a>
                        </li>
                        <li><a href="<?= Url::to($logoutUrl) ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
