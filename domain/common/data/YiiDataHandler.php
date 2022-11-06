<?php declare(strict_types=1);

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
    protected ?QueryInterface $query = null;


    public function __construct(
        QueryInterface $query
    ) {
        $this->query = $query;
        $this->queryBackup = clone $query;
    }

    /**
     * Restores query to default
     */
    protected function resetQuery(): void
    {
        $this->query = clone $this->queryBackup;
    }

    protected function getOne(array|int $criteria): ActiveRecordAdapter
    {
        $dto = $this->findOne($criteria);
        if ($dto) {
            return $dto;
        }
        throw new \yii\web\NotFoundHttpException();
    }

    protected function findOne(array|int $criteria): ?ActiveRecordAdapter
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
        // exclude null values
        return array_filter($data, function ($value) {
            return $value !== null;
        });
    }
}
