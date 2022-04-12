<?php

namespace factories;

use src\ArrayableInterface;

interface DataFactoryInterface
{
    public function makeDto(ArrayableInterface|array|null $data): ?object;
    public function setDtoClass(string $className): void;
}
