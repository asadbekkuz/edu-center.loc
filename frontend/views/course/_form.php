<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use frontend\models\Employee;
use frontend\models\Room;
use frontend\models\Science;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Course $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin([
            'id' => 'saveForm',
            'options' => [
                'method' => 'post'
            ]
    ]); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'science_id')->dropDownList(ArrayHelper::map(Science::find()->all(),'id','name'),[
                    'prompt' => 'select science ...'
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'start_date')->widget(DateTimePicker::class,[
                'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                'value' => date('Y-m-d H:i',time()),
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd hh:ii'
                ]
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'end_date')->widget(DateTimePicker::class,[
                'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
                'value' => date('Y-m-d H:i',time()),
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd hh:ii'
                ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'teacher_id')->dropDownList(ArrayHelper::map(Employee::find()->all(),'id','first_name'),[
                'prompt' => 'select teacher ...'
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'room_id')->dropDownList(ArrayHelper::map(Room::find()->all(),'id','name'),[
                'prompt' => 'select room ...'
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'price')->textInput() ?>
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
