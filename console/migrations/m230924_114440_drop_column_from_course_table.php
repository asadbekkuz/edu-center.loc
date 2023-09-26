<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%course}}`.
 */
class m230924_114440_drop_column_from_course_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('course','capacity');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('course','capacity',$this->integer(2)->after('price'));
    }
}
