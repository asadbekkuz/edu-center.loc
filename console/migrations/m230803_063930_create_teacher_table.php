<?php

use common\components\migrations\CustomMigration;


/**
 * Handles the creation of table `{{%teacher}}`.
 */
class m230803_063930_create_teacher_table extends CustomMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%teacher}}', [
            'id' => $this->primaryKey(),
            'user_id'=> $this->integer(11),
            'science_id' => $this->integer(11),
            'salary' => $this->float(2),
            'status'=>$this->integer(2),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' =>$this->integer()
        ]);

        $this->customAddForeignKey('teacher','created_by','user','id');
        $this->customAddForeignKey('teacher','updated_by','user','id');
        $this->customAddForeignKey(
            'teacher',
            'user_id',
            'user',
            'id'
        );

        $this->customAddForeignKey(
            'teacher',
            'science_id',
            'science',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->customDropForeignKey('teacher','updated_by');
        $this->customDropForeignKey('teacher','created_by');

        $this->customDropForeignKey(
            'teacher',
            'science_id'
        );

        $this->customDropForeignKey(
            'teacher',
            'user_id'
        );

        $this->dropTable('{{%teacher}}');
    }
}
