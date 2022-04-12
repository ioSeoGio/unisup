<?php

namespace data;

interface CreatorInterface extends DtoReturnableInterface
{
    const PRIMARY_KEY = 'id';


    public function create(array $data): object;
    public function createMany(array $data): array;
}
