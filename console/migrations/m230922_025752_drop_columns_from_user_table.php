<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%user}}`.
 */
class m230922_025752_drop_columns_from_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user','first_name');
        $this->dropColumn('user','last_name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('user','first_name',$this->string(200));
        $this->addColumn('user','last_name',$this->string(200));
    }
}
