<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Science $model */

$this->title = Yii::t('app', 'Create Science');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sciences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="science-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
