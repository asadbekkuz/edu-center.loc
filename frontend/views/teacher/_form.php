<?php

use common\models\User;
use frontend\models\Science;
use frontend\models\Teacher;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Teacher $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->teacher()->asArray()->all(),'id','full_name'),[
            'prompt' => 'Xodimni tanlang...'
    ]) ?>

    <?= $form->field($model, 'science_id')->dropDownList(ArrayHelper::map(Science::find()->asArray()->all(),'id','name'),[
            'prompt' => 'Yo\'nalishni tanlang...'
    ]) ?>

    <?= $form->field($model, 'salary')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(Teacher::getStatusLabels()) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="far fa-save"></i>&nbsp&nbsp'.Yii::t('app', 'Save'), [
            'class' => 'btn btn-warning',
            'id' => 'saveButton'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
