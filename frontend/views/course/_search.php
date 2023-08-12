<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\search\CourseSearch $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="course-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'science_id') ?>

    <?= $form->field($model, 'teacher_id') ?>

    <?= $form->field($model, 'room_id') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'capacity') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
