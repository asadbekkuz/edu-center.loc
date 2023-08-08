<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var \frontend\models\Group $model */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="post-view">
    <div class="card">
        <div class="card-body">
            <p>
                <?= Html::a("<i class='fas fa-pen'> </i>  ".Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
                <?= Html::a("<i class='fas fa-trash'> </i> ".Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-outline-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'student_id',
                    'course_id',
                    [
                        'attribute' => 'status',
                        'value' => fn($model) => $model->showStatus($model->status),
                        'format'=>'html'
                    ],
                    'created_at',
                    'updated_at',
                    'created_by',
                    'updated_by'
                ],
            ]) ?>
        </div>
    </div>
</div>
