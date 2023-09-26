<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class UserController extends Controller
{
    public function actionCreate($username = null, $password = null)
    {
        $user = new User();
        $user->username = $username ?: 'admin';
        $user->email = 'admin@example.com';
        $user->generateAuthKey();
        $user->status = 10;
        $password = $password ?: Yii::$app->security->generateRandomString(8);
        $user->setPassword($password);
        $user->created_at = date('now');
        $user->updated_at = '';

        if ($user->save()) {
            Console::output('User has been created');
            Console::output("Username: " . $username);
            Console::output("Password: " . $password);
        } else {
            Console::error("User \"$username\" was not created");
            var_dump($user->errors);
        }
    }
}
