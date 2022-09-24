<?php declare(strict_types=1);

namespace data;

interface DeleterInterface
{
    const PRIMARY_KEY = 'id';

    public function deleteOneById(int $id): bool;
    public function deleteManyByIds(array $ids): bool;
    public function deleteOneByCriteria(array $criteria): bool;
    public function deleteManyByCriteria(array $criteria): bool;
}
