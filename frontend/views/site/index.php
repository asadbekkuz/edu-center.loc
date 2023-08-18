<?php

$this->title = 'Dashboard';


if(Yii::$app->user->can('admin'))
{
    echo "This is admin";
}
if(Yii::$app->user->can('teacher'))
{
    echo "this is teacher";
}
?>

