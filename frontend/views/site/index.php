<?php


use yii\base\Event;
use yii\web\View;

/**
 * @var $lidStudent \frontend\models\Student
 * @var $activeStudent \frontend\models\Student
 * @var $groups \frontend\models\Group
 * @var $paymentDebtor \frontend\models\Payment
 * @var $this \yii\web\View
 * @var $dateTime \frontend\models\Course
 */
$this->title = 'Dashboard';
?>
<style>
    #calendar {
        /*max-width: 1100px;*/
        margin: 0 auto;
    }
</style>
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
    <div id="calendar"></div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        let date = new Date().toJSON().slice(0, 10);

        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone:'local',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            initialDate: date,
            navLinks: true, // can click day/week names to navigate views
            businessHours: true, // display business hours
            editable: true,
            selectable: true,
            events: <?= $dateTime ?>
        });
        calendar.render();
    });
</script>
<?php
    $this->registerJsFile('./js/index.global.js',['depends'=>\yii\web\JqueryAsset::class]);
?>

