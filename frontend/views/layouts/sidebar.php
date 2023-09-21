<?php

use yii\helpers\Url;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::to(['/site/index']) ?>" class="brand-link">
        <img src="<?= Yii::getAlias('@web') ?>/images/logo/img.png" alt="Admin" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Education - CRM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= Yii::getAlias('@web') ?>/images/logo/user.jpg" class="img-circle elevation-2" alt="User Image">
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
                        'label' => Yii::t('app', 'Dashboard'),
                        'url' => Url::to(['/site/index']),
                        'icon' => 'fas fa-home',
                        'visible' => Yii::$app->user->can('admin')
                    ],
                    [
                        'label' => Yii::t('app', 'Xodimlar'),
                        'icon' => 'fas fa-user-friends',
                        'items' => [
                            ['label' => Yii::t('app','Barcha Xodimlar'), 'url' => Url::to(['/user/index']), 'iconStyle' => 'far'],
                            ['label' => Yii::t('app', 'Teacher'), 'url' => Url::to(['/teacher/index']), 'iconStyle' => 'far'],
                            ['label' => Yii::t('app','Xabar yuborish'), 'url' => Url::to(['/user/message']), 'iconStyle' => 'far'],
                        ],
                        'visible' => Yii::$app->user->can('admin')
                    ],
                    [
                        'label' => Yii::t('app', 'Courses'),
                        'icon' => 'fad fa-layer-group',
                        'items' => [
                            ['label' => Yii::t('app','Barcha kurslar'), 'url' => Url::to(['/course/index']), 'iconStyle' => 'far'],
                            ['label' => Yii::t('app', 'Group'), 'url' => Url::to(['/group/index']), 'iconStyle' => 'far'],
                            ['label' => Yii::t('app','Yo\'nalishlar'), 'url' => Url::to(['/science/index']), 'iconStyle' => 'far'],
                        ],
                        'visible' => Yii::$app->user->can('admin')
                    ],
                    [
                        'label' => Yii::t('app', 'Student'),
                        'icon' => 'fas fa-user-graduate',
                        'items' => [
                            ['label' => Yii::t('app','O\'quvchilar'), 'url' => Url::to(['/student/index']), 'iconStyle' => 'far'],
                            ['label' => Yii::t('app', 'To\'lov'), 'url' => Url::to(['/payment/index']), 'iconStyle' => 'far'],
                            ['label' => Yii::t('app','Xabar yuborish'), 'url' => Url::to(['/student/message']), 'iconStyle' => 'far'],
                        ],
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('teacher')
                    ],
                    [
                        'label' => Yii::t('app', 'Room'),
                        'url' => Url::to(['/room/index']),
                        'icon' => 'far fa-door-open',
                        'visible' => Yii::$app->user->can('admin')
                    ],
                    [
                        'label' => Yii::t('app', 'Setting'),
                        'icon' => 'fas fa-cogs',
                        'items' => [
                            ['label' => Yii::t('app','Profile'), 'url' => Url::to(['/user/profile']), 'iconStyle' => 'far'],
                            ['label' => Yii::t('app','Log out'), 'url' => Url::to(['/site/logout']), 'iconStyle' => 'far'],
                        ],
                        'visible' => Yii::$app->user->can('admin') || Yii::$app->user->can('teacher')
                    ]
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>