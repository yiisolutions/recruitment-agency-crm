<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 * @var \app\models\User $userModel
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yiister\gentelella\widgets\Menu;

$bundle = yiister\gentelella\assets\Asset::register($this);
$user = Yii::$app->getUser();
$userModel = $user->getIdentity();

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>" >
<?php $this->beginBody(); ?>
<div class="container body">

    <div class="main_container">

        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0;">
                    <a href="/" class="site_title"><i class="fa fa-briefcase"></i> <span><?= Yii::$app->name ?></span></a>
                </div>
                <div class="clearfix"></div>

                <!-- menu prile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="http://placehold.it/128x128" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span><?= Yii::t('app', 'Welcome') ?>,</span>
                        <h2><?= $userModel ?></h2>
                    </div>
                </div>
                <!-- /menu prile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <?= Menu::widget([
                            'items' => [
                                [
                                    'label' => Yii::t('app', 'Dashboard'),
                                    'url' => ['/dashboard/index'],
                                    'icon' => 'dashboard',
                                ],
                                [
                                    'label' => Yii::t('app', 'Customers'),
                                    'url' => '#',
                                    'icon' => 'square',
                                    'items' => [
                                        [
                                            'label' => Yii::t('app', 'Employers'),
                                            'url' => ['/employer/index'],
                                            'icon' => 'square-o',
                                            'visible' => $user->can('employer_read'),
                                        ],
                                        [
                                            'label' => Yii::t('app', 'Applicants'),
                                            'url' => ['/applicant/index'],
                                            'icon' => 'square-o',
                                            'visible' => $user->can('applicant_read'),
                                        ],
                                    ],
                                ],
                                [
                                    'label' => Yii::t('app', 'Content'),
                                    'url' => '#',
                                    'icon' => 'square',
                                    'items' => [
                                        [
                                            'label' => Yii::t('app', 'Vacancies'),
                                            'url' => ['/vacancy/index'],
                                            'icon' => 'square-o',
                                            'visible' => $user->can('vacancy_read'),
                                        ],
                                        [
                                            'label' => Yii::t('app', 'Resumes'),
                                            'url' => ['/resume/index'],
                                            'icon' => 'square-o',
                                            'visible' => $user->can('resume_read'),
                                        ],
                                    ],
                                ],
                                [
                                    'label' => Yii::t('app', 'References'),
                                    'url' => '#',
                                    'icon' => 'square',
                                    'items' => [
                                        [
                                            'label' => Yii::t('app', 'Currencies'),
                                            'url' => ['/currency/index'],
                                            'icon' => 'square-o',
                                            'visible' => $user->can('currency_read'),
                                        ],
                                        [
                                            'label' => Yii::t('app', 'Locations'),
                                            'url' => ['/location/index'],
                                            'icon' => 'square-o',
                                            'visible' => $user->can('location_read'),
                                        ],
                                        [
                                            'label' => Yii::t('app', 'Scopes'),
                                            'url' => ['/scope/index'],
                                            'icon' => 'square-o',
                                            'visible' => $user->can('scope_read'),
                                        ],
                                        [
                                            'label' => Yii::t('app', 'Skills'),
                                            'url' => ['/skill/index'],
                                            'icon' => 'square-o',
                                            'visible' => $user->can('skill_read'),
                                        ],
                                    ],
                                ],
                                [
                                    'label' => Yii::t('app', 'Administration'),
                                    'url' => '#',
                                    'icon' => 'square',
                                    'items' => [
                                        [
                                            'label' => Yii::t('app', 'Users'),
                                            'url' => ['/user/index'],
                                            'icon' => 'square-o',
                                            'visible' => $user->can('user_read'),
                                        ],
                                    ],
                                ],
                                [
                                    'label' => Yii::t('app', 'Development'),
                                    'url' => '#',
                                    'icon' => 'code',
                                    'visible' => YII_ENV_DEV,
                                    'items' => [
                                        [
                                            'label' => Yii::t('app', 'Gii'),
                                            'url' => ['/gii/default/index'],
                                            'icon' => 'square-o',
                                        ],
                                        [
                                            'label' => Yii::t('app', 'Debug'),
                                            'url' => ['/debug/default/index'],
                                            'icon' => 'square-o',
                                        ],
                                    ],
                                ],
                            ],
                        ]) ?>
                    </div>
                    <div class="menu_section">
                        <h3><?= Yii::t('app', 'Language') ?></h3>
                        <?= Html::beginForm(['/site/language'], 'post') ?>
                        <?= Html::dropDownList('language', Yii::$app->language, [
                            'en' => Yii::t('app', 'English'),
                            'ru' => Yii::t('app', 'Russian'),
                        ], ['class' => 'form-control', 'onchange' => 'this.form.submit()']) ?>
                        <?= Html::endForm() ?>
                    </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?= Url::to(['/account/logout']) ?>">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
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
                                <li><a href="javascript:;">  <?= Yii::t('app', 'Profile') ?></a>
                                </li>
                                <li><a href="<?= Url::to(['/account/logout']) ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php if (isset($this->params['h1'])): ?>
                <div class="page-title">
                    <div class="title_left">
                        <h1><?= $this->params['h1'] ?></h1>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>

            <?= $content ?>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com" rel="nofollow" target="_blank">Colorlib</a><br />
                Extension for Yii framework 2 by <a href="http://yiister.ru" rel="nofollow" target="_blank">Yiister</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<!-- /footer content -->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
