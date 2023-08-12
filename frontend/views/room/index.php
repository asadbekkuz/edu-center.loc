<?php

use common\components\CustomActionColumn;
use frontend\models\Room;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var frontend\models\search\RoomSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Rooms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">
    <div class="card">
        <div class="card-body">
            <p>
                <?= Html::a('<i class="fas fa-plus-circle"></i>  ' . Yii::t('app', 'Create Room'),
                    Url::to(['/room/create']),
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
                    'name',
                    [
                          'attribute' =>'floor',
                          'value' => fn($model) => $model->floor . '-'.Yii::t('app','floor')
                    ],
                    [
                          'attribute' => 'capacity',
                          'value' => fn($model) => $model->capacity . '-'.Yii::t('app','persons')
                    ],

                    'description:ntext',
                    [
                        'class' => CustomActionColumn::class
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div
</div>
