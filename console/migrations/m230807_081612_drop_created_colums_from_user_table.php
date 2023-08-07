<?php

use common\components\migrations\CustomMigration;
use yii\db\Migration;

/**
 * Handles the dropping of table `{{%created_colums_from_user}}`.
 */
class m230807_081612_drop_created_colums_from_user_table extends CustomMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->customDropForeignKey('user','created_by');
        $this->customDropForeignKey('user','updated_by');
        $this->dropColumn('{{%user}}','created_by');
        $this->dropColumn('{{%user}}','updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return false;
    }
}
