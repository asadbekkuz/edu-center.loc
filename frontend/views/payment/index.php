<?php

use frontend\models\Payment;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var frontend\models\PaymentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Payments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-index">
    <div class="card">
        <div class="card-body">
            <p>
                <?= Html::a('<i class="fas fa-plus-circle"></i>  ' . Yii::t('app', 'Add Payment'),
                    Url::to(['/payment/create']),
                    [
                        'class' => 'btn btn-outline-success',
                        'id' => 'create-button'
                    ]) ?>
            </p>
            <?php Modal::begin([
                'id' => 'modal',
                'size' => Modal::SIZE_LARGE
            ]);

            echo "<div id='modal-content'></div>";

            Modal::end(); ?>
            <?php Pjax::begin(['id' => 'pjaxGrid']); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    [
                        'attribute'=>'student_id',
                        'value' => fn($model) => $model->student->first_name.' '.$model->student->last_name
                    ],
                    [
                        'attribute' => 'course_id',
                        'value' => fn($model) => $model->course->name
                    ],
                    'price',
                    'created_at:datetime',
                    [
                        'attribute' => 'status',
                        'value' => fn($model) => $model->showStatus($model->status),
                        'filter' => Html::activeDropDownList($searchModel,
                            'status',
                            Payment::filterDropDown(),
                            [
                                'class'=>'form-control',
                                'prompt' => ' ']),
                        'format' => 'html',
                    ],
                    //'updated_at',
                    [
                        'class' => \common\components\CustomActionColumn::class,
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
