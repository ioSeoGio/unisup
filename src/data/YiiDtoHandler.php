<?php

namespace data;

use seog\db\QueryInterface;
use factories\DataFactoryInterface;

abstract class YiiDtoHandler extends YiiDataHandler implements DtoReturnableInterface
{
	public function __construct(
        protected QueryInterface $query,
        protected DataFactoryInterface $factory
	) {
		parent::__construct($query);
	}

    /**
     * Sets new format of data returning
     * @param $className str
     */
    public function setDtoClass(string $className): void
    {
        $this->factory->setDtoClass($className);
    }

    /**
     * @return ?object
     */
    protected function getDTO(): ?object
    {
        return $this->factory->makeDto(
            $this->query->one()
        );
    }

    /**
     * @return array
     */
    protected function getDTOs(): array
    {
        $dtos = [];
        foreach ($this->query->each() as $model) {
            $dtos[] = $this->factory->makeDto($model); 
        }
        return $dtos;
    }
}
