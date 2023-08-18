<?php

use yii\db\Migration;

/**
 * Class m230817_231040_init_rbac
 */
class m230817_231040_init_admin_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $controllers = ['user','group','room','science','site','student','teacher','course'];
        $actions = ['index','view','delete','update','create'];

        $auth = Yii::$app->authManager;
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $teacher = $auth->createRole('teacher');
        $auth->add($teacher);

        foreach ($controllers as $controller) {
            foreach ($actions as $action)
            {
                $actionName = $action.''.ucfirst($controller);
                $$actionName =  $auth->createPermission($actionName);
                $$actionName->description = ucfirst($actionName).' a '.$controller;
                $auth->add($$actionName);
                if($controller === 'student')
                {
                    $auth->addChild($teacher,$$actionName);
                }
                $auth->addChild($admin,$$actionName);
            }
        }
        $auth->assign($admin,15);
        $auth->assign($teacher,16);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
