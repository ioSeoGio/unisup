<?php

namespace seog\db;

use yii\db\Command as BaseCommand;

class Command extends BaseCommand
{
    /**
     * Creates an INSERT command with RETURNING ID.
     *
     * For example,
     *
     * ```php
     * $connection->createCommand()->insertWithReturningId('user', [
     *     'name' => 'Sam',
     *     'age' => 30,
     * ])->execute();
     * ```
     *
     * The method will properly escape the column names, and bind the values to be inserted.
     *
     * Note that the created command is not executed until [[execute()]] is called.
     *
     * @param string $table the table that new rows will be inserted into.
     * @param array|\yii\db\Query $columns the column data (name => value) to be inserted into the table or instance
     * of [[yii\db\Query|Query]] to perform INSERT INTO ... SELECT SQL statement.
     * Passing of [[yii\db\Query|Query]] is available since version 2.0.11.
     * @return $this the command object itself
     */
    public function insertWithReturningId($table, $columns)
    {
        $params = [];
        $sql = $this->db->getQueryBuilder()->insert($table, $columns, $params);
        $sql .= ' RETURNING [[id]]';

        return $this->setSql($sql)->bindValues($params);
    }
}