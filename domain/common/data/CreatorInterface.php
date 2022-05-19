<?php

namespace data;

interface CreatorInterface
{
    const PRIMARY_KEY = 'id';

    public function create(array|object $data): object;
    public function createMany(array $data): array;
}
