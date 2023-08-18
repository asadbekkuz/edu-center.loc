<?php

use yii\db\Migration;

/**
 * Class m230818_040212_add_type_colum_to_user_table
 */
class m230818_040212_add_type_colum_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','type',$this->string(50)->after('email'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','type');
    }

}
