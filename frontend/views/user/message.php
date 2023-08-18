<?php

/**
 *
 * @var $user \common\models\User
 */

use common\models\User;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <?php $form = ActiveForm::begin() ?>
                <div class="form-group">
                    <?= $form->field($user, 'status')->dropDownList(User::getStatusLabels(), [
                        'prompt' => 'Statusni tanlang...'
                    ]) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($user, 'type')->dropDownList(User::getPositionLabel(), [
                        'prompt' => 'Lavozimni tanlang...'
                    ]) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($user, 'body')->textarea([
                        'style' => [
                            'resize' => 'none'
                        ],
                        'rows' => 6
                    ]) ?>
                </div>
                <?= Html::submitButton('<i class="far fa-paper-plane"></i>&nbsp&nbsp' . Yii::t('app', 'Send Message'), [
                    'class' => 'btn btn-success',
                    'id' => 'saveButton',
                    'style' => [
                        'margin-top' => '30px'
                    ]
                ]) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>


<!--<div class="card">-->
<!--    <div class="card-body">-->
<!--        <div class="row">-->
<!--            <div class="col-lg-2"></div>-->
<!--            <div class="col-lg-8">-->
<!--                <div class="row">-->
<!--                    -->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    --><?php //= $form->field($user, 'type')->dropDownList(User::getPositionLabel(), [
//                        'prompt' => 'Lavozimni tanlang...'
//                    ]) ?>
<!--                </div>-->
<!--                <div class="row">-->
<!--                    --><?php //= $form->field($user, 'body')->textarea([
//                        'style' => [
//                            'resize' => 'none',
//                            'rows' => 4
//                        ]
//                    ]) ?>
<!--                </div>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                --><?php //= Html::submitButton('<i class="far fa-save"></i>&nbsp&nbsp' . Yii::t('app', 'Save'), [
//                    'class' => 'btn btn-warning',
//                    'id' => 'saveButton',
//                    'style' => [
//                        'margin-top' => '30px'
//                    ]
//                ]) ?>
<!--            </div>-->
<!--            <div class="col-lg-2"></div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

