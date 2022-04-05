<?php

namespace data;

interface RepositoryInterface
{
    const DESC = SORT_DESC;
    const ASC = SORT_ASC;
    const PRIMARY_KEY = 'id';

    /**
     * @param $with array
     * @return self
     */
    public function with(array $with = []): self;

    /**
     * @param $columns array
     * @return self
     */
    public function select(array $columns = ['*']): self;

    /**
     * @param $limit int
     * @return self
     */
    public function limit(int $limit = 50): self;

    /**
     * @param $columns array
     * @return self
     */
    public function orderBy($columns = [self::PRIMARY_KEY => self::ASC]): self;

    /**
     * @return array
     */
    public function one(): object;

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @return object
     */
    public function asDataProvider(int $pageSize = 50): object;

    /**
     * @param $id int
     * @return array|object
     */
    public function findOneById(int $id): object;

    /**
     * @param $ids array
     * @param $limit int
     *
     * @return array
     */
    public function findManyByIds(array $ids, int $limit = 50): array;

    /**
     * @param $criteria array
     * @param $with array
     *
     * @return object
     */
    public function findOneByCriteria(array $criteria = [], array $with = []): object;

    /**
     * @param $criteria array
     * @param $limit int
     * @param $with array
     *
     * @return array
     */
    public function findManyByCriteria(array $criteria = [], int $limit = 50, array $with = []): array;

    /**
     * @param $limit int
     * @return array
     */
    public function findAll(int $limit = 50): array;
}
