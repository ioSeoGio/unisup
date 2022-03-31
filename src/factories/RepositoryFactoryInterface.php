<?php

namespace factories;

interface RepositoryFactoryInterface
{
    public function makeDTO(array|object $data): object;
}
