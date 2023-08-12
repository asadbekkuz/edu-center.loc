<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Science $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="science-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="far fa-save"></i>&nbsp&nbsp'.Yii::t('app', 'Save'), [
            'class' => 'btn btn-warning',
            'id' => 'saveButton'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
