<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \frontend\models\Course $model */

$this->title = Yii::t('app', 'Update Group: {name}', [
    'name' => '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Group'), 'url' => ['index']];

?>
<div class="post-update">
    <div class="card">
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
