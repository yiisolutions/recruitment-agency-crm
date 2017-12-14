<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 * @var \app\models\User $userModel
 */

use bedezign\yii2\audit\web\JSLoggingAsset;
use yii\helpers\Html;
use yiister\gentelella\assets\Asset;

JSLoggingAsset::register($this);

$bundle = Asset::register($this);
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
            <?= $this->render('main/_left.php', [
                'brand' => Yii::$app->name,
                'brandUrl' => '/',
                'user' => $user,
                'userModel' => $userModel,
            ]) ?>
        </div>

        <?= $this->render('main/_top.php', [
            'userModel' => $userModel,
            'logoutUrl' => ['/account/logout'],
            'profileUrl' => ['/account/profile'],
        ]) ?>

        <?= $this->render('main/_content.php', [
            'content' => $content,
        ]) ?>
    </div>
</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
