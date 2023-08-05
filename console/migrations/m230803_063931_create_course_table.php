<?php

use common\components\migrations\CustomMigration;

/**
 * Handles the creation of table `{{%course}}`.
 */
class m230803_063931_create_course_table extends CustomMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%course}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(100)->notNull(),
            'science_id'=>$this->integer(11)->notNull(),
            'teacher_id'=>$this->integer(11)->notNull(),
            'room_id'=>$this->integer(11)->notNull(),
            'price' => $this->float(2)->notNull(),
            'capacity' => $this->integer(2),
            'status' => $this->integer(1),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
            'updated_by' =>$this->integer(11)
        ]);

        $this->customAddForeignKey(
            'course',
            'science_id',
            'science',
            'id'
        );
        $this->customAddForeignKey(
            'course',
            'teacher_id',
            'teacher',
            'id'
        );
        $this->customAddForeignKey(
            'course',
            'room_id',
            'room',
            'id'
        );

        $this->customAddForeignKey('course','created_by','user','id');
        $this->customAddForeignKey('course','updated_by','user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->customDropForeignKey('course','updated_by');
        $this->customDropForeignKey('course','created_by');
        $this->customDropForeignKey(
            'course',
            'science_id'
        );
        $this->customDropForeignKey(
            'course',
            'teacher_id'
        );
        $this->customDropForeignKey(
            'course',
            'room_id'
        );
        $this->dropTable('{{%course}}');
    }
}
