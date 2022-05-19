<?php

namespace data;

use seog\db\QueryInterface;
use seog\db\ActiveRecordAdapter;

abstract class YiiDataHandler
{
    /**
     * Backup of query, setted in constructor
     * Used to restore query to default state
     */
    protected QueryInterface $queryBackup;


    public function __construct(
        protected QueryInterface $query
    ) {
        $this->queryBackup = clone $query;
    }

    /**
     * Restores query to default
     */
    protected function resetQuery(): void
    {
        $this->query = clone $this->queryBackup;
    }

    protected function findOne(array|int $criteria): ActiveRecordAdapter
    {
        return $this->query
            ->modelClass::findOne($criteria);
    }

    protected function findMany(array $criteria): array
    {
        $models = $this->query
            ->where($criteria)
            ->all();
        $this->resetQuery();
        return $models;
    }

    protected function makeArray(array|object $data): array
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        return $data;
    }
}
