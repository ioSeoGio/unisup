<?php

namespace data;

use yii\data\ActiveDataProvider;
use factories\DataFactoryInterface;

abstract class YiiArRepository extends YiiDtoHandler implements RepositoryInterface
{
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
        $dto = $this->getDTO($this->query->one());
        $this->resetQuery();
        return $dto;
    }

    public function all(): array
    {
        $dtos = $this->getDTOs($this->query);
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

    public function findOneById(int $id): ?object
    {
        $this->query
            ->where([self::PRIMARY_KEY => $id]);
        return $this->getDTO();
    }

    public function findManyByIds(array $ids, int $limit = 50): array
    {
        $this->query
            ->where(['in', self::PRIMARY_KEY, $ids])
            ->limit(50);
        return $this->getDTOs();
    }

    public function findOneByCriteria(array $criteria = [], array $with = []): ?object
    {
        $this->query
            ->where($criteria)
            ->with($with);
        return $this->getDTO();
    }

    public function findManyByCriteria(array $criteria = [], int $limit = 50, array $with = []): array
    {
        $this->query
            ->where($criteria)
            ->with($with)
            ->limit($limit);
        return $this->getDTOs();
    }

    public function findAll(int $limit = 50): array
    {
        $this->query
            ->limit($limit);
        return $this->getDTOs();
    }
}
