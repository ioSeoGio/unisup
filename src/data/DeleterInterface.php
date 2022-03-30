<?php

namespace data;

interface DeleterInterface
{
    const PRIMARY_KEY = 'id';

    /**
     * @param $id int
     * @return bool
     */
    public function deleteOneById(int $id): bool;

    /**
     * @param $ids array
     * @return bool
     */
    public function deleteManyByIds(array $ids): bool;

    /**
     * @param $criteria array
     * @return bool
     */
    public function deleteOneByCriteria(array $criteria = []): bool;

    /**
     * @param $criteria array
     * @return bool
     */
    public function deleteManyByCriteria(array $criteria = []): bool;
}
