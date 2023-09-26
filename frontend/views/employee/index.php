<?php

use frontend\models\Employee;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var frontend\models\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Employees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">
    <div class="card">
        <div class="card-body">
            <p>
                <?= Html::a('<i class="fas fa-plus-circle"></i>  ' . Yii::t('app', 'Create Employee'),
                    Url::to(['/employee/create']),
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
                        'attribute' =>'user_id',
                        'value' => fn($model) => $model->user->username
                    ],
                    [
                        'attribute' => 'science_id',
                        'value' => fn($model) => $model->science->name
                    ],
                    'first_name',
                    'last_name',
                    'address',
                    'phone',
                    //'salary',
                    [
                        'attribute' => 'status',
                        'value' => fn($model) => $model->showStatus($model->status),
                        'format' => 'raw'
                    ],
                    //'created_at',
                    //'updated_at',
                    //'created_by',
                    //'updated_by',
                    [
                        'class' => \common\components\CustomActionColumn::class,
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div
</div>
