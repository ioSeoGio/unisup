<?php

namespace seog\db;

use yii\db\Migration as BaseMigration;

class Migration extends BaseMigration
{
    /**
     * Creates and executes an INSERT SQL statement.
     * The method will properly escape the column names, and bind the values to be inserted.
     * @param string $table the table that new rows will be inserted into.
     * @param array $columns the column data (name => value) to be inserted into the table.
     */
    public function insertWithReturningId($table, $columns)
    {
        $time = $this->beginCommand("insert into $table returning id");
        $command = $this->db->createCommand()->insertWithReturningId($table, $columns);
        $result = $command->execute();
        $this->endCommand($time);

        return $result;
    }
}
