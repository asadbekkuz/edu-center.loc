<?php

use yii\helpers\Url;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="Admin" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">OPUS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= Yii::t('app','admin') ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
//                    ['label' => 'Yii2 PROVIDED', 'header' => true],
                    [
                            'label' => Yii::t('app','Employees'),
                            'url' => Url::to(['/user/index']),
                            'icon' => 'far fa-user',
                            'items' => [
                                ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
                                ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                            ]
//                            'visible' => Yii::$app->user->isGuest
                    ],
                    [
                            'label' => Yii::t('app','Courses'),
                            'url' => Url::to(['/course/index']),
                            'icon' => 'far fa-bookmark',
//                            'visible' => Yii::$app->user->isGuest
                    ],
                    [
                            'label' => Yii::t('app','Groups'),
                            'url' => Url::to(['/group/index']),
                            'icon' => 'fas fa-users',
//                            'visible' => Yii::$app->user->isGuest
                    ],
                    [
                            'label' => Yii::t('app','Room'),
                            'url' => Url::to(['/room/index']),
                            'icon' => 'fas fa-warehouse',
//                            'visible' => Yii::$app->user->isGuest
                    ],
                    [
                            'label' => Yii::t('app','Subject'),
                            'url' => Url::to(['/science/index']),
                            'icon' => 'fas fa-directions',
//                            'visible' => Yii::$app->user->isGuest
                    ],
                    [
                            'label' => Yii::t('app','Student'),
                            'url' => Url::to(['/student/index']),
                            'icon' => 'fas fa-user-graduate',
//                            'visible' => Yii::$app->user->isGuest
                    ],
                    [
                            'label' => Yii::t('app','Teacher'),
                            'url' => Url::to(['/teacher/index']),
                            'icon' => 'fas fa-chalkboard-teacher',
//                            'visible' => Yii::$app->user->isGuest
                    ],
                    [
                            'label' => 'Gii',
                            'icon' => 'file-code',
                            'url' => ['/gii'],
                            'target' => '_blank'
                    ],
                    [
                            'label' => 'Debug',
                            'icon' => 'bug',
                            'url' => ['/debug'],
                            'target' => '_blank'
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>