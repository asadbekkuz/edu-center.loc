<?php

use frontend\models\Course;
use frontend\models\Student;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Group $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin([
        'id' => 'saveForm',
        'options' => [
            'method' => 'post'
        ]
    ]); ?>

    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'student_id')->dropDownList(ArrayHelper::map(Student::find()->getByFullname()->asArray()->all(),'id','name'),[
                'prompt' => 'select student ...'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'course_id')->dropDownList(ArrayHelper::map(Course::find()->all(),'id','name'),[
                'prompt' => 'select course ...'
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'status')->widget(\kartik\switchinput\SwitchInput::class, [
                'inlineLabel' => false,
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success','id'=>'saveButton']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
