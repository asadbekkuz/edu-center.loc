<?php

/** @var $model \frontend\models\Group */
/** @var $newModel \frontend\models\Group */
/** @var $pagination \yii\data\Pagination */
/** @var $sort  \yii\data\Sort */

use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

?>
<div class="card">
    <div class="card-body">

        <p>
            <button class="btn btn-outline-success" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fas fa-plus"></i> <?= Yii::t('app','Create Group');?>
            </button>
        </p>

        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <?= Yii::$app->session->has('danger') ? Yii::$app->session->get('danger') : ''; ?>
                <?= $this->render('_form', [
                    'model' => $newModel,
                ]) ?>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?= Yii::t('app',$sort->link('student_id'));?></th>
                <th><?= Yii::t('app',$sort->link('course_id'));?></th>
                <th><?= Yii::t('app',$sort->link('status'));?></th>
                <th><?= Yii::t('app',$sort->link('created_at'));?></th>
                <th><?= Yii::t('app',$sort->link('updated_at'));?></th>
                <th><?= Yii::t('app',$sort->link('created_by'));?></th>
                <th><?= Yii::t('app',$sort->link('updated_by'));?></th>
                <th><a href="javascript:void(0)">Actions</a></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $value): ?>
                <tr>
                    <td><?= $value->student_id ?></td>
                    <td><?= $value->course_id ?></td>
                    <td><?= $value->status ?></td>
                    <td><?= $value->created_at ?></td>
                    <td><?= $value->updated_at ?></td>
                    <td><?= $value->created_by ?></td>
                    <td><?= $value->updated_by ?></td>

                    <td style="display: flex;">
                        <a href="<?= Url::to(['group/update','id'=>$value->id])?>" class="btn btn-outline-info"><i class="fas fa-pen"></i></a>
                        <a href="<?= Url::to(['group/delete','id'=>$value->id])?>" class="btn btn-outline-danger mx-2"><i class="fas fa-trash"></i></a>
                        <a href="<?= Url::to(['group/view','id'=>$value->id])?>" class="btn btn-outline-success"><i class="fas fa-eye"></i></a>
                    </td>

                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<?php

echo LinkPager::widget([
    'pagination' =>$pagination,
    'options' => [
        'class' => 'mt-2'
    ]
])
?>

