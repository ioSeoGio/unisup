<?php

namespace data;

interface UpdaterInterface
{
    const PRIMARY_KEY = 'id';

    /**
     * @param $id int
     * @param $data array
     * @return bool
     */
    public function updateOneById(int $id, array $data = []): bool;

    /**
     * @param $ids array
     * @param $data array
     * @return bool
     */
    public function updateManyByIds(array $ids, array $data = []): bool;

    /**
     * @param $criteria array
     * @param $data array
     *
     * @return bool
     */
    public function updateOneByCriteria(array $criteria, array $data = []): bool;

    /**
     * @param $criteria array
     * @param $data array
     *
     * @return bool
     */
    public function updateManyByCriteria(array $criteria = [], array $data = []): bool;
}
