<?php

use common\components\CustomActionColumn;
use frontend\models\Science;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var frontend\models\search\ScienceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Sciences');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="science-index">
    <div class="card">
        <div class="card-body">
            <p>
                <?= Html::a('<i class="fas fa-plus-circle"></i>  ' . Yii::t('app', 'Create Science'),
                    Url::to(['/science/create']),
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
                        'attribute' => 'status',
                        'value' => fn($model) => $model->showStatus($model->status),
                        'filter' => Html::activeDropDownList($searchModel,
                            'status',
                            Science::filterDropDown(),
                            [
                                'class'=>'form-control',
                                'prompt' => '']),
                        'format' => 'html',
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
//                    'created_by',
//                    'updated_by',
                    [
                        'class' => CustomActionColumn::class,
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div
</div>
