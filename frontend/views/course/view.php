<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Course $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Courses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="course-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary update-button']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
            [
                'attribute' => 'science_id',
                'value' => fn($model) => $model->science->name
            ],
            [
                'attribute' => 'teacher_id',
                'value' => fn($model) => $model->employee->first_name.' '.$model->employee->last_name
            ],
            [
                'attribute' => 'room_id',
                'value' => fn($model) => $model->room->name
            ],
            'price',
            'capacity',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'created_by',
                'value' => fn($model) => $model->created->username
            ],
            [
                'attribute' => 'updated_by',
                'value' => fn($model) => $model->updated->username
            ]
        ],
    ]) ?>

</div>
