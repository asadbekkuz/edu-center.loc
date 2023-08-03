<?php


namespace common\components;
class CustomMigration extends \yii\db\Migration
{
    /** add foreign key to created by table */
    protected function addCreatedBy($table = '',$refTable = '',$refColumn = 'id')
    {
        /** add index for created_by column */
        $this->createIndex(
            "idx-$table-created_by",
            "$table",
            'created_by');

        /** add foreign key for created_by column */
        $this->addForeignKey(
            "fk-$table-created_by",
            "$table",
            'created_by',
            "$refTable",
            "$refColumn",
        'CASCADE');
    }


    /** add foreign key to updated by table */
    protected function addUpdatedBy($table = '',$refTable = '',$refColumn = 'id')
    {
        /** add index for updated_by column */
        $this->createIndex(
            "idx-$table-updated_by",
            "$table",
            "updated_by");

        /** add foreign key for updated_by column */
        $this->addForeignKey(
            "fk-$table-updated_by",
            "$table",
            'updated_by',
            "$refTable",
            "$refColumn",
            'CASCADE');
    }


    /** drop foreign key for created_by */
    protected function dropCreatedBy($table = '')
    {
        $this->dropForeignKey(
            "fk-$table-created_by",
            "$table");

        $this->dropIndex("idx-$table-created_by","$table");
    }

    /** drop foreign key for updated_by */
    protected function dropUpdatedBy($table = '')
    {
        $this->dropForeignKey(
            "fk-$table-updated_by",
            "$table");

        $this->dropIndex("idx-$table-updated_by","$table");
    }
}