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
    public function columns(array $columns = ['*']): self;

    /**
     * @param $limit int
     * @return self
     */
    public function limit(int $limit = 50): self;

    /**
     * @param $orderBy str
     * @param $sort int
     *
     * @return self
     */
    public function orderBy(string $orderBy, int $sort = SORT_DESC): self;

    /**
     * @return array
     */
    public function one(): array;

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @return object
     */
    public function asDataProvider(): object;

    /**
     * Restore query to default
     */
    public function restoreQuery(): void;

    /**
     * @param $id int
     * @return array|object
     */
    public static function findOneById(int $id): object;

    /**
     * @param $ids array
     * @param $limit int
     *
     * @return array
     */
    public static function findManyByIds(array $ids, int $limit = 50): array;

    /**
     * @param $criteria array
     * @param $with array
     *
     * @return object
     */
    public static function findOneByCriteria(array $criteria = [], array $with = []): object;

    /**
     * @param $criteria array
     * @param $limit int
     * @param $with array
     *
     * @return array
     */
    public static function findManyByCriteria(array $criteria = [], int $limit = 50, array $with = []): array;

    /**
     * @param $limit int
     * @return array
     */
    public static function findAll(int $limit = 50): array;
}
