<?php declare(strict_types=1);

namespace data;

interface UpdaterInterface
{
    const PRIMARY_KEY = 'id';


    public function updateOneById(int $id, array|object $data): object;
    public function updateManyByIds(array $ids, array|object $data): array;
    public function updateOneByCriteria(array $criteria, array|object $data): object;
    public function updateManyByCriteria(array $criteria, array|object $data): array;
}
