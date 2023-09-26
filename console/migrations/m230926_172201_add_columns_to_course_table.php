<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%course}}`.
 */
class m230926_172201_add_columns_to_course_table extends \common\components\migrations\CustomMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {   
        $this->addColumn('course','start_date',$this->dateTime()->after('name'));
        $this->addColumn('course','end_date',$this->dateTime()->after('name'));
        $this->customDropForeignKey('payment','course_id');
        $this->customAddForeignKey('payment','course_id','course','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('course','end_date');
        $this->dropColumn('course','start_date');
    }
}
