<?php

namespace data;

interface CreatorInterface
{
    const PRIMARY_KEY = 'id';

    /**
     * @param $data array
     * @return bool
     */
    public function create(array $data): bool;

    /**
     * @param $data array
     * @return bool
     */
    public function createMany(array $data): bool;
}
