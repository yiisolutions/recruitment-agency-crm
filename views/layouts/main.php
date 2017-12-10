<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $user = Yii::$app->getUser();
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'activateParents' => true,
        'items' => [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('app', 'Gii'), 'url' => ['/gii/default/index']],
            ['label' => Yii::t('app', 'Content'), 'items' => [
                ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index'], 'visible' => $user->can('user_read')],
                ['label' => Yii::t('app', 'Employers'), 'url' => ['/employer/index'], 'visible' => $user->can('employer_read')],
                ['label' => Yii::t('app', 'Applicants'), 'url' => ['/applicant/index'], 'visible' => $user->can('applicant_read')],
                ['label' => Yii::t('app', 'Vacancies'), 'url' => ['/vacancy/index'], 'visible' => $user->can('vacancy_read')],
                ['label' => Yii::t('app', 'Resumes'), 'url' => ['/resume/index'], 'visible' => $user->can('resume_read')],
                ['label' => Yii::t('app', 'Locations'), 'url' => ['/location/index'], 'visible' => $user->can('location_read')],
                ['label' => Yii::t('app', 'Scopes'), 'url' => ['/scope/index'], 'visible' => $user->can('scope_read')],
                ['label' => Yii::t('app', 'Skills'), 'url' => ['/skill/index'], 'visible' => $user->can('skill_read')],
                ['label' => Yii::t('app', 'Currencies'), 'url' => ['/currency/index'], 'visible' => $user->can('currency_read')],
            ]],
            '<li>'
            . Html::beginForm(['/site/language'], 'post')
            . Html::dropDownList('language', Yii::$app->language ?: null, [
                'ru' => Yii::t('app', 'Russian'),
                'en' => Yii::t('app', 'English'),
            ], ['class' => 'form-control lang-selector', 'onchange' => 'this.form.submit()'])
            . Html::endForm()
            . '</li>',
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/account/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/account/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
