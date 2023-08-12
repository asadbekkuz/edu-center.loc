<?php
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Inflector;

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <?php
                        if (!is_null($this->title)) {
                            echo Html::encode($this->title);
                        } else {
                            echo Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content m-2">
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>