<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payment}}`.
 */
class m230825_114531_create_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payment}}', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer(11)->notNull(),
            'course_id' => $this->integer(11)->notNull(),
            'price' => $this->decimal(10,2)->notNull(),
            'status' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        $this->createIndex(
            'idx-payment-student_id',
            'payment',
            'student_id'
        );

        $this->addForeignKey(
            'fk-payment-student_id',
            'payment',
            'student_id',
            'student',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-payment-course_id',
            'payment',
            'course_id'
        );

        $this->addForeignKey(
            'fk-payment-course_id',
            'payment',
            'course_id',
            'course',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-payment-course_id','payment');
        $this->dropForeignKey('fk-payment-student_id','payment');

        $this->dropIndex('idx-payment-course_id','payment');
        $this->dropIndex('idx-payment-student_id','payment');
        $this->dropTable('{{%payment}}');
    }
}
