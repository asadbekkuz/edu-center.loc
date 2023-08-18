<?php

use yii\helpers\Url;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::to(['/site/index']) ?>" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="Admin" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">OPUS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= Url::to(['/user/setting']) ?>"
                   class="d-block"><?= Yii::$app->user->identity->username ?? 'Unkown' ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => Yii::t('app', 'Xodimlar'),
                        'icon' => 'fas fa-user-friends',
                        'items' => [
                            ['label' => Yii::t('app','Barcha Xodimlar'), 'url' => Url::to(['/user/index']), 'iconStyle' => 'far'],
                            ['label' => Yii::t('app','Xabar yuborish'), 'url' => Url::to(['/user/message']), 'iconStyle' => 'far'],
                        ],
                        'visible' => Yii::$app->user->can('admin')
                    ],
                    [
                        'label' => Yii::t('app', 'Courses'),
                        'url' => Url::to(['/course/index']),
                        'icon' => 'fad fa-layer-group',
                        'visible' => Yii::$app->user->can('admin')
                    ],
                    [
                        'label' => Yii::t('app', 'Groups'),
                        'url' => Url::to(['/group/index']),
                        'icon' => 'fas fa-users',
                        'visible' => Yii::$app->user->can('admin')
                    ],
                    [
                        'label' => Yii::t('app', 'Room'),
                        'url' => Url::to(['/room/index']),
                        'icon' => 'far fa-door-open',
                        'visible' => Yii::$app->user->can('admin')
                    ],
                    [
                        'label' => Yii::t('app', 'Subject'),
                        'url' => Url::to(['/science/index']),
                        'icon' => 'fas fa-graduation-cap',
                        'visible' => Yii::$app->user->can('admin')
                    ],
                    [
                        'label' => Yii::t('app', 'Student'),
                        'url' => Url::to(['/student/index']),
                        'icon' => 'fas fa-user-graduate',
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('teacher')
                    ],
                    [
                        'label' => Yii::t('app', 'Teacher'),
                        'url' => Url::to(['/teacher/index']),
                        'icon' => 'fas fa-chalkboard-teacher',
                        'visible' => Yii::$app->user->can('admin')
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