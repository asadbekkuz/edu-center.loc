<?php

/**
 * @var $model \frontend\models\Course
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $searchModel \frontend\models\search\CourseSearch
 */

use frontend\models\Course;
use yii\bootstrap4\LinkPager;
use yii\bootstrap4\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Course';
?>
<div class="card">
    <div class="card-body">
        <p>
            <?= Html::a('<i class="fas fa-plus-circle"></i>  ' . Yii::t('app', 'Create Course'),
                Url::to(['/course/create']), [
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
            'pager' => [
                   'class' => LinkPager::class,
                   'prevPageLabel' => Yii::t('app','Prev'),
                   'nextPageLabel' => Yii::t('app','Next')
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'science_id',
                'teacher_id',
                'room_id',
                'price',
                'capacity',
                [
                    'attribute' => 'status',
                    'value' => fn($model) => $model->showStatus($model->status),
                    'filter' => Html::activeDropDownList($searchModel,
                            'status',
                                     Course::filterDropDown(),
                                    [
                                        'class'=>'form-control',
                                        'prompt' => 'select']),
                    'format' => 'html',
                ],
                [
                    'class' => 'common\components\CustomActionColumn',
                ]
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>

