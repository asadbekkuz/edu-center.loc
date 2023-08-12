<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
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
    <?= Html::submitButton(Yii::t('app', Yii::t('app', 'Save')),[
            'class' => 'btn btn-success',
            'id' => 'saveButton'
    ]) ?>


    <?php ActiveForm::end(); ?>

</div>
