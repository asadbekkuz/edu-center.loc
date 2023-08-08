<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\bootstrap4\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html class="no-js" lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= Url::base() ?>img/favicon.png">
    <script src="<?= Url::base()?>js/modernizr-3.6.0.min.js"></script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Preloader Start Here -->
<div id="preloader"></div>
<!-- Preloader End Here -->
<div id="wrapper" class="wrapper bg-ash">
    <!-- Header Menu Area Start Here -->
    <?= $this->render('_header') ?>
    <!-- Header Menu Area End Here -->

    <!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        <?= $this->render('_sidebar') ?>
        <!-- Sidebar Area End Here -->
        <div class="dashboard-content-one">
            <?= $content ?>
            <!-- Footer Area Start Here -->
            <?= $this->render('_footer'); ?>
            <!-- Footer Area End Here -->
        </div>
    </div>
    <!-- Page Area End Here -->
</div>
</body>
<?php $this->endBody(); ?>
</html>
<?php $this->endPage(); ?>
