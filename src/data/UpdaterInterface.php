<?php

namespace data;

interface UpdaterInterface extends DtoReturnableInterface
{
    const PRIMARY_KEY = 'id';


    public function updateOneById(int $id, array $data = []): object;
    public function updateManyByIds(array $ids, array $data = []): array;
    public function updateOneByCriteria(array $criteria, array $data = []): object;
    public function updateManyByCriteria(array $criteria = [], array $data = []): array;
}
