<?php

use common\models\User;
use frontend\models\Course;
use frontend\models\Room;
use frontend\models\Science;
use frontend\models\Teacher;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var Course $model */
/** @var yii\widgets\ActiveForm $form */

$url = Url::to(['course/create']);
if(!$model->isNewRecord)
{
    $url = Url::to(['course/update','id' => $model->id]);
}
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
            'action' => $url
    ]); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'science_id')->dropDownList(ArrayHelper::map(Science::findAll(['status'=>1]),'id','name'),[
                    'prompt' => 'Select science...'
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'teacher_id')->dropDownList(ArrayHelper::map(Teacher::findAll(['status'=>1]),'id','name'),[
                    'prompt' => 'select a teacher...'
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'room_id')->dropDownList(ArrayHelper::map(Room::find()->all(),'id','name'),[
                    'prompt' => 'Select a room...'
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'capacity')->input('number',['min' => 1]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'status')->dropDownList(Course::getStatusLabels(),[
                    'prompt' => 'Statusni tanlang...'
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= Html::submitButton(Yii::t('app', Yii::t('app', 'Save')), ['class' => 'btn btn-success','style'=>'margin-top:30px']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
