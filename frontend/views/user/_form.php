<?php

use common\models\User;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this
 * @var User $model
 * @var yii\widgets\ActiveForm $form
 *
 */

?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
            'id' => 'saveForm'
    ]); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'first_name')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'username')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'phone')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'address')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'email')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'status')->dropDownList(User::getStatusLabels(),[
                    'prompt' => 'Statusni tanlang...'
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app','Password')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'type')->dropDownList(User::getPositionLabel(),[
                'prompt' => 'Lavozimni tanlang...'
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= Html::submitButton('<i class="far fa-save"></i>&nbsp&nbsp'.Yii::t('app', 'Save'), [
                'class' => 'btn btn-warning',
                'id' => 'saveButton',
                'style' => [
                        'margin-top' => '30px'
                ]
            ]) ?>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>
