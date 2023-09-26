<?php

use yii\db\Migration;

/**
 * Class m230922_092418_change_table_name
 */
class m230922_092418_change_table_name extends \common\components\migrations\CustomMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee}}', [
            'id' => $this->primaryKey(),
            'user_id'=> $this->integer(11),
            'science_id' => $this->integer(11),
            'first_name' => $this->string(100)->notNull(),
            'last_name' => $this->string(100)->notNull(),
            'address' => $this->string(200)->notNull(),
            'phone' => $this->string(45)->notNull(),
            'salary' => $this->float(2),
            'status'=>$this->integer(2),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' =>$this->integer()
        ]);

        $this->customAddForeignKey('employee','created_by','user','id');
        $this->customAddForeignKey('employee','updated_by','user','id');
        $this->customAddForeignKey(
            'employee',
            'user_id',
            'user',
            'id'
        );

        $this->customAddForeignKey(
            'employee',
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
        $this->customDropForeignKey('employee','updated_by');
        $this->customDropForeignKey('employee','created_by');

        $this->customDropForeignKey(
            'employee',
            'science_id'
        );

        $this->customDropForeignKey(
            'employee',
            'user_id'
        );

        $this->dropTable('{{%employee}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230922_092418_change_table_name cannot be reverted.\n";

        return false;
    }
    */
}
