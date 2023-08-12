<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Room $model */
/** @var yii\bootstrap4\ActiveForm $form */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin([
        'id' => 'saveForm'
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'floor')->textInput() ?>

    <?= $form->field($model, 'capacity')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="far fa-save"></i>&nbsp&nbsp'.Yii::t('app', 'Save'), [
                'class' => 'btn btn-warning',
                'id' => 'saveButton'
            ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
