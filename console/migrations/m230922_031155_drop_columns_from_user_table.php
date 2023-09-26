<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%user}}`.
 */
class m230922_031155_drop_columns_from_user_table extends \common\components\migrations\CustomMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->customDropForeignKey('user','updated_by');
        $this->customDropForeignKey('user','created_by');
        $this->dropColumn('user','created_by');
        $this->dropColumn('user','updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('user','created_by',$this->integer(11));
        $this->addColumn('user','updated_by',$this->integer(11));
    }
}
