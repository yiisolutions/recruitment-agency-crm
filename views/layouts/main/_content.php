<?php
/**
 * Content for main layout.
 */

use yii\web\View;

/** @var View $this */
/** @var string $content */

?>

<div class="right_col" role="main">
    <?php if (isset($this->params['h1'])): ?>
        <div class="page-title">
            <div class="title_left">
                <h1><?= $this->params['h1'] ?></h1>
            </div>
        </div>
    <?php endif; ?>
    <div class="clearfix"></div>

    <?= $content ?>
</div>
