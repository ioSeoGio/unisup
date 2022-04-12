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

    /**
     * @param $criteria array|int
     * @return object
     */
    protected function findOne(array|int $criteria): ActiveRecordAdapter
    {
        return $this->query
            ->modelClass::findOne($criteria);
    }

    /**
     * @param $criteria array
     * @return array
     */
    protected function findMany(array $criteria): array
    {
        $models = $this->query
            ->where($criteria)
            ->all();
        $this->resetQuery();
        return $models;
    }
}
