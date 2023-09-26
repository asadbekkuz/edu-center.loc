<?php

use common\components\migrations\CustomMigration;
use yii\db\Migration;

/**
 * Class m230926_065106_changed_foreign_key_column
 */
class m230926_065106_changed_foreign_key_column extends CustomMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->customDropForeignKey(
            'course',
            'teacher_id'
        );
        $this->customAddForeignKey('course','teacher_id','employee','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->customDropForeignKey('course','teacher_id');
        $this->customAddForeignKey('course','teacher_id','teacher','id');
    }

}
