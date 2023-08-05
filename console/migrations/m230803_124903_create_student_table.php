<?php

use common\components\migrations\CustomMigration;

/**
 * Handles the creation of table `{{%student}}`.
 */
class m230803_124903_create_student_table extends CustomMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%student}}', [
            'id' => $this->primaryKey(),
            'first_name' =>$this->string(100),
            'last_name' =>$this->string(100),
            'phone' =>$this->string(20),
            'email' => $this->string(200),
            'address' => $this->string(250),
            'status' => $this->integer(2),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' =>$this->integer()
        ]);

        $this->customAddForeignKey('student','created_by','user','id');
        $this->customAddForeignKey('student','updated_by','user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->customDropForeignKey('student','updated_by');
        $this->customDropForeignKey('student','created_by');
        $this->dropTable('{{%student}}');
    }
}
