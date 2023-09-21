<?php

namespace console\controllers;

use common\models\User;
use yii\console\Controller;

class UserController extends Controller
{


  public function actionCreate($username = null, $password = null)
  {
    $user = new User();
    $user->username = $username ?? 'admin';
    $user->generateAuthKey();
    $user->status = 10;
    $user->password = $password ?? '12345678';
    $user->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($user->password);
    if ($user->save()) {
      echo $user->username . ' is saved';
    }
    echo "Error";
  }
}
