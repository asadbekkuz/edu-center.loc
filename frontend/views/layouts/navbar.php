<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
               class="nav-link dropdown-toggle">
                <?='<img src="'.Url::base().'/images/flag/'.Yii::$app->language.'.png" 
                alt="'.Yii::$app->language.'" style="width:25px">'.ucfirst(Yii::t('app', 'language'))?>
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <?php
                foreach (Yii::$app->params['language'] as $key=>$value){
                    ?>

                    <?php
                    $tilFlag = '<img src="'.Url::base().'/images/flag/'.$key.'.png" alt="'.Yii::$app->language.'" style="width:25px">'
                    ?>
                    <li>
                        <?php echo Html::a($tilFlag.$value, ['/site/change-lang','lang'=>$key ], [ 'class' => 'dropdown-item']) ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->