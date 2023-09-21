<?php


use yii\base\Event;

/**
 * @var $lidStudent \frontend\models\Student
 * @var $activeStudent \frontend\models\Student
 * @var $groups \frontend\models\Group
 * @var $paymentDebtor \frontend\models\Payment
 */
$this->title = 'Dashboard';
?>

<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <?= \hail812\adminlte\widgets\InfoBox::widget([
            'text' => 'Faol lidlar',
            'number' => $lidStudent,
            'iconTheme'=> 'warning',
            'icon' => 'fas fa-user',
        ]) ?>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <?= \hail812\adminlte\widgets\InfoBox::widget([
            'text' => 'Faol talabalar',
            'number' => $activeStudent,
            'iconTheme' => 'success',
            'icon' => 'fas fa-user-graduate',
        ]) ?>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <?= \hail812\adminlte\widgets\InfoBox::widget([
            'text' => 'Guruhlar',
            'number' => $groups,
            'iconTheme' => 'info',
            'icon' => 'fas fa-users',
        ]) ?>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <?= \hail812\adminlte\widgets\InfoBox::widget([
            'text' => 'Qarzdorlar',
            'number' => $paymentDebtor,
            'iconTheme' => 'danger',
            'icon' => 'fas fa-user-minus',
        ]) ?>
    </div>
</div>

<div class="row">

</div>

