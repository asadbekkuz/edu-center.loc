<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$label = 'Username';
?>
<div class="align-items-center">
    <div class="col-3 mx-auto">
        <div class="text-center">
            <img id="profile-img" class="rounded-circle profile-img-card" src="https://i.imgur.com/6b6psnA.png" />
        </div>
    </div>
</div>

<section>

<div class="signin">

    <div class="content">
        <h2>Log In</h2>
            <?php $form = ActiveForm::begin(['id' => 'login-form','options' => ['class' => 'form'],
                'fieldConfig'=>[
                    'template' => "{input}\n{error}",
//                   'inputTemplate' => "{input}",
                ]
            ])?>
            <div class="inputBox">
                <?= $form->field($model,'username')->textInput([
                        'placeholder' => 'Username',
                        'class' =>false
                ])->label(false); ?>
            </div>
            <div class="inputBox">
                <?= $form->field($model,'password')->passwordInput([
                        'placeholder' =>'Password',
                        'class' =>false
                ])->label(false) ?>
            </div>
            <div class="inputBox">
                <?= Html::submitButton('Login',
                    [
                        'class' => 'btn btn-success mb-4',
                        'name' => 'login-button',
                        'style' => [
                                'width'=>'100%'
                        ]
                    ]) ?>
<!--                <input type="submit" value="Login">-->
            </div>
            <?php ActiveForm::end() ?>
    </div>
</div>
</section>
<!--<div class="container h-80">-->
<!--    <div class="row align-items-center h-100">-->
<!--        <div class="col-3 mx-auto">-->
<!--            <div class="text-center">-->
<!--                <img id="profile-img" class="rounded-circle profile-img-card" src="https://i.imgur.com/6b6psnA.png" />-->
<!--                <p id="profile-name" class="profile-name-card"></p>-->
<!--                --><?php //$form = ActiveForm::begin(['id' => 'login-form']); ?>
<!---->
<!--                    --><?php //= $form->field($model, 'username')->textInput([
//                            'autofocus' => true,
//                            'placeholder' => 'username'
//                        ])->label(false) ?>
<!--                    --><?php //= $form->field($model, 'password')->passwordInput([
//                            'placeholder' => 'password'
//                    ])->label(false) ?>
<!--                    <div class="form-group">-->
<!--                        --><?php //= Html::submitButton('Login', [
//                            'class' => 'btn btn-primary',
//                            'name' => 'login-button',
//                            'style' => [
//                                'display' => 'inline-block'
//                            ]
//                        ]) ?>
<!--                    </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

