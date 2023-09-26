<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Employee $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

    <h1><?= Html::encode($model->username) ?></h1>

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
            'salary',
            [
                'attribute' => 'status',
                'value' => fn($model) => $model->showStatus($model->status),
                'format' => 'raw'
            ],
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
