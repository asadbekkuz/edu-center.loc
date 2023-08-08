<?php

/** @var $model \common\models\User */
/** @var $newModel \common\models\User */
/** @var $pagination \yii\data\Pagination */
/** @var $sort  \yii\data\Sort */

use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

?>
<div class="card">
    <div class="card-body">

        <p>
            <button class="btn btn-outline-success" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fas fa-plus"></i> <?= Yii::t('app','Create User');?>
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
                <th><?= Yii::t('app',$sort->link('username'));?></th>
                <th><?= Yii::t('app',$sort->link('first_name'));?></th>
                <th><?= Yii::t('app',$sort->link('last_name'));?></th>
                <th><?= Yii::t('app',$sort->link('phone'));?></th>
                <th><?= Yii::t('app',$sort->link('status'));?></th>
                <th><a href="javascript:void(0)">Actions</a></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $value): ?>
                <tr>
                    <td><?= $value->username ?></td>
                    <td><?= $value->first_name ?></td>
                    <td><?= $value->last_name ?></td>
                    <td><?= $value->phone ?></td>
                    <td><?= $value->showStatus($value->status) ?></td>

                    <td style="display: flex;">
                        <a href="<?= Url::to(['user/update','id'=>$value->id])?>" class="btn btn-outline-info"><i class="fas fa-pen"></i></a>
                        <a href="<?= Url::to(['user/delete','id'=>$value->id])?>" class="btn btn-outline-danger mx-2"><i class="fas fa-trash"></i></a>
                        <a href="<?= Url::to(['user/view','id'=>$value->id])?>" class="btn btn-outline-success"><i class="fas fa-eye"></i></a>
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

