<?php

/**
 * @var $model \common\models\User
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $searchModel \common\models\UserSearch
 */

use common\models\User;
use yii\bootstrap4\LinkPager;
use yii\bootstrap4\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = Yii::t('app','Xodim');;
?>
<div class="card">
    <div class="card-body">
        <p>
            <?= Html::a('<i class="fas fa-plus-circle"></i>  ' . Yii::t('app', 'Xodim yaratish'),
                Url::to(['/user/create']), [
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
                'username',
                'first_name',
                'last_name',
                [
                    'attribute' => 'status',
                    'value' => fn($model) => $model->getStatus($model->status),
                    'filter' => Html::activeDropDownList($searchModel,
                            'status',
                                     User::getStatusLabels(),
                                    [
                                        'class'=>'form-control',
                                        'prompt' => 'select']),
                    'format' => 'html',
                ],
                'email',
                [
                    'class' => 'common\components\CustomActionColumn',
                ]
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>

