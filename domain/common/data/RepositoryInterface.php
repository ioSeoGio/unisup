<?php

namespace data;

interface RepositoryInterface
{
    const DESC = SORT_DESC;
    const ASC = SORT_ASC;
    const PRIMARY_KEY = 'id';

    public function criteria(array $criteria): self;
    public function with(array $with = []): self;
    public function select(array $columns = ['*']): self;
    public function limit(int $limit = 50): self;
    public function orderBy($columns = [self::PRIMARY_KEY => self::ASC]): self;
    public function one(): ?object;
    public function all(): array;
    public function asDataProvider(int $pageSize = 50): object;
    public function findOneById(int $id, array $with = []): ?object;
    public function findManyByIds(array $ids, int $limit = 50): array;
    public function findOneByCriteria(array $criteria = [], array $with = []): ?object;
    public function findManyByCriteria(array $criteria = [], int $limit = 50, array $with = []): array;
    public function findAll(int $limit = 50): array;
}
