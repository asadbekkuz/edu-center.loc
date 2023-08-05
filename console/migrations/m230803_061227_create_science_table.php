<?php

use common\components\migrations\CustomMigration;

/**
 * Handles the creation of table `{{%science}}`.
 */
class m230803_061227_create_science_table extends CustomMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%science}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
            'status' => $this->integer(2),
            'created_at'=>$this->integer(11),
            'updated_at'=>$this->integer(11),
            'created_by'=>$this->integer(11),
            'updated_by' => $this->integer(11)
        ]);

        $this->customAddForeignKey('science','created_by','user','id');
        $this->customAddForeignKey('science','updated_by','user','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->customDropForeignKey('science','updated_by');
        $this->customDropForeignKey('science','created_by');
        $this->dropTable('{{%science}}');
    }
}
