<?php

namespace data;

use yii\data\ActiveDataProvider;
use factories\DataFactoryInterface;

abstract class YiiArRepository extends YiiDataHandler implements RepositoryInterface
{
    public function criteria(array $criteria): self
    {
        $this->query
            ->where($criteria);
        return $this;
    }

    public function with(array $with = []): self
    {
        $this->query
            ->with($with);
        return $this;
    }

    public function select(array $columns = ['*']): self
    {
        $this->query
            ->select($columns);
        return $this;
    }

    public function limit(int $limit = 50): self
    {
        $this->query
            ->limit($limit);
        return $this;
    }

    public function orderBy($columns = [self::PRIMARY_KEY => self::ASC]): self
    {
        $this->query
            ->orderBy($columns);
        return $this;
    }

    public function one(): ?object
    {
        $dto = $this->query->one();
        $this->resetQuery();
        return $dto;
    }

    public function all(): array
    {
        $dtos = $this->query->all();
        $this->resetQuery();
        return $dtos;
    }

    public function asDataProvider(int $pageSize = 50): ActiveDataProvider
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);
        $this->resetQuery();
        return $dataProvider;
    }

    public function getOneById(int $id, array $with = []): object
    {
        $dto = $this->query
            ->where([self::PRIMARY_KEY => $id])
            ->with($with)
            ->one();
        if ($dto) {
            return $dto;
        }
        throw new \yii\web\NotFoundHttpException();
    }

    public function findOneById(int $id, array $with = []): ?object
    {
        return $this->query
            ->where([self::PRIMARY_KEY => $id])
            ->with($with)
            ->one();
    }

    public function findManyByIds(array $ids, int $limit = 50): array
    {
        return $this->query
            ->where(['in', self::PRIMARY_KEY, $ids])
            ->limit(50)
            ->all();
    }

    public function findOneByCriteria(array $criteria = [], array $with = []): ?object
    {
        return $this->query
            ->where($criteria)
            ->with($with)
            ->one();
    }

    public function findManyByCriteria(array $criteria = [], int $limit = 50, array $with = []): array
    {
        return $this->query
            ->where($criteria)
            ->with($with)
            ->limit($limit)
            ->all();
    }

    public function findAll(int $limit = 50): array
    {
        return $this->query
            ->limit($limit)
            ->all();
    }
}
