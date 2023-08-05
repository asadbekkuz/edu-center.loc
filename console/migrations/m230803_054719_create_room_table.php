<?php

use common\components\migrations\CustomMigration;


/**
 * Handles the creation of table `{{%rooms}}`.
 */
class m230803_054719_create_room_table extends CustomMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%room}}', [
            'id' => \yii\db\Schema::TYPE_PK,
            'name' => $this->string(),
            'floor' => $this->integer(2),
            'capacity' => $this->smallInteger(2),
            'description'=>$this->text()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%room}}');
    }
}
