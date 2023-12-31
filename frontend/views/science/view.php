<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Science $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sciences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="science-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'),
            ['update', 'id' => $model->id],
            [
                'class' => 'btn btn-primary update-button',
                'id' => 'update-button'
            ]) ?>
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
            ],
        ],
    ]) ?>

</div>
