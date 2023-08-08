<?php

use common\models\User;
use frontend\models\Course;
use frontend\models\Group;
use frontend\models\Group as GroupAlias;
use frontend\models\Room;
use frontend\models\Science;
use frontend\models\Student;
use frontend\models\Teacher;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var Course $model */
/** @var yii\widgets\ActiveForm $form */

$url = Url::to(['group/create']);
if(!$model->isNewRecord)
{
    $url = Url::to(['group/update','id' => $model->id]);
}
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
            'action' => $url
    ]); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'student_id')->dropDownList(ArrayHelper::map(Student::findAll(['status'=>10]),'id','name'),[
                'prompt' => 'Select student...'
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'course_id')->dropDownList(ArrayHelper::map(Course::findAll(['status'=>10]),'id','name'),[
                    'prompt' => 'Select course...'
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'status')->dropDownList(Group::getStatusLabels(),[
                    'prompt' => 'Statusni tanlang...'
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= Html::submitButton(Yii::t('app', Yii::t('app', 'Save')), ['class' => 'btn btn-success','style'=>'margin-top:30px']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
