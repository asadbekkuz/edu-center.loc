<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var common\models\LoginForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$label = 'Username';
?>
<div class="align-items-center">
    <div class="col-3 mx-auto">
        <div class="text-center">
            <img id="profile-img" alt="image" class="rounded-circle profile-img-card" src="<?= Yii::getAlias('@web/images/login/mask.png') ?>" />
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
            </div>
            <?php ActiveForm::end() ?>
    </div>
</div>
</section>


