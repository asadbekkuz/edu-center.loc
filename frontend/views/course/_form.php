<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Course $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'science_id')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'teacher_id')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'room_id')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'capacity')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'status')->textInput() ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
