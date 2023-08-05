<?php


namespace common\components\migrations;

use yii\db\Migration;

class CustomMigration extends Migration
{

    protected function customAddForeignKey($table = '',$column = '',$refTable = '',$refColumn = '')
    {

        $this->createIndex(
            "idx-$table-$column",
            "$table",
            "$column");

        $this->addForeignKey(
            "fk-$table-$column",
            "$table",
            "$column",
            "$refTable",
            "$refColumn",
            'CASCADE');
    }

    protected function customDropForeignKey($table = '',$column = '')
    {
        $this->dropForeignKey(
            "fk-$table-$column",
            "$table");

        $this->dropIndex("idx-$table-$column","$table");
    }
}