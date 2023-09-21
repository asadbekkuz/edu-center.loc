<?php


/**
 *
 * @var $user \common\models\User
 */

use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

?>

<div class="card">
    <div class="card-body">

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                    Information
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                    Profile Image
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact"
                        type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                    Change password
                </button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">

            <!-- users information            -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <?php $informationForm = ActiveForm::begin([
                    'action' => Url::to('/user/information'),
                    'method' => 'post'
                ]) ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $informationForm->field($user, 'first_name')->textInput() ?>
                        <?= $informationForm->field($user, 'id')->hiddenInput([
                            'value' => $user->id
                        ])->label(false) ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $informationForm->field($user, 'last_name')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $informationForm->field($user, 'username')->textInput() ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $informationForm->field($user, 'phone')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $informationForm->field($user, 'address')->textInput() ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $informationForm->field($user, 'email')->textInput() ?>
                    </div>
                </div>
                <?= Html::submitButton('<i class="far fa-save"></i>&nbsp&nbsp' . Yii::t('app', 'Save'), [
                    'class' => 'btn btn-warning',
                ]) ?>
                <?php ActiveForm::end() ?>
            </div>

            <!-- user's image            -->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <?php $imageForm = ActiveForm::begin(
                        [
                            'action' => Url::to('/user/image'),
                            'options' => ['enctype' => 'multipart/form-data'],
                            'method' => 'post'
                ]) ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $imageForm->field($user, 'imageFile')->widget(FileInput::class, [
                            'options' => [
                                'multiple' => false
                            ],
                            'pluginOptions' => [
                                'initialPreview' => [
//                                    "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg",
                                ],
                                'initialPreviewAsData' => true,
                                'initialCaption' => "User Image",
                                'overwriteInitial' => true,
                                'maxFileSize' => 1024 * 8
                            ]
                        ]) ?>
                    </div>

                </div>
                <?= Html::submitButton('<i class="far fa-save"></i>&nbsp&nbsp' . Yii::t('app', 'Save'), [
                    'class' => 'btn btn-warning',
                ])
                ?>

                <?php ActiveForm::end() ?>
            </div>

            <!-- Change password            -->
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <?php $passwordForm = ActiveForm::begin(['action' => Url::to('/user/password')]) ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $passwordForm->field($user, 'old_password')->passwordInput() ?>
                        <?= $passwordForm->field($user, 'id')->hiddenInput([
                            'value' => $user->id
                        ])->label(false) ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $passwordForm->field($user, 'new_password')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <?= Html::submitButton('<i class="far fa-save"></i>&nbsp&nbsp' . Yii::t('app', 'Save'), [
                    'class' => 'btn btn-warning',
                ]) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>


    </div>
</div>