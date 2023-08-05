<?php

use common\components\migrations\CustomMigration;

/**
 * Handles the creation of table `{{%group}}`.
 */
class m230803_125440_create_group_table extends CustomMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group}}', [
            'id' => $this->primaryKey(),
            'student_id'=>$this->integer(11),
            'course_id' => $this->integer(11),
            'status' => $this->integer(2),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' =>$this->integer(11)
        ]);

        $this->customAddForeignKey(
            'group',
            'student_id',
            'student',
            'id'
        );

        $this->customAddForeignKey(
            'group',
            'course_id',
            'course',
            'id'
        );
        $this->customAddForeignKey('group','created_by','user','id');
        $this->customAddForeignKey('group','updated_by','user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->customDropForeignKey('group','updated_by');
        $this->customDropForeignKey('group','created_by');
        $this->customDropForeignKey('group','course_id');
        $this->dropTable('{{%group}}');
    }
}
