<?php

use frontend\models\Science;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Employee $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin([
        'id' => 'saveForm',
        'options' => [
            'method' => 'post'
        ]
    ]); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput([
                'id' => 'employee_username'
            ]) ?>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" class="input-group-text btn btn-success" id="password_generate">Generate
                        </button>
                    </div>
                    <input type="text" class="form-control" name="Employee[password]" id="password_field">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'email')->input('email') ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'science_id')->dropDownList(ArrayHelper::map(Science::find()->all(), 'id', 'name'), [
                'prompt' => 'select science ...'
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
                'mask' => '+\9\9\8-99-999-99-99',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'salary')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->widget(\kartik\switchinput\SwitchInput::class, [
                'inlineLabel' => false,
            ]) ?>
        </div>
    </div>
    <div class="invalid-feedback" id="error_message">   </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success', 'id' => 'saveButton']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$script = <<<JS
    $(document).ready(function(){
        $('#employee_username').on('change',function() {
            generatePassword()
        })
        $('#password_generate').on('click',function() {
            generatePassword()
        })
    });
    function generatePassword(length = 8) {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
          counter += 1;
        }
        $('#password_field').val(result)
    }
JS;

$this->registerJs($script);
?>

