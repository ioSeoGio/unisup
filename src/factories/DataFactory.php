<?php

namespace factories;

use src\ArrayableInterface;

class DataFactory implements DataFactoryInterface
{
	public function __construct(
		private string $dtoClass
	) {}

	/**
	 * @param $data \src\ArrayableInterface|array
	 * @return ?object
	 */
	public function makeDto(ArrayableInterface|array|null $data): ?object
	{
		$attributes = $data;
		if ($data instanceof ArrayableInterface) {
			$attributes = $data->asArray();
		} elseif ($data === null) {
			return null;
		}

		$dto = new $this->dtoClass();
		foreach ($attributes as $attributeName => $attributeValue) {
			if ($this->isAttributeValid($attributeValue, $attributeName, $dto)) {
				$this->changeAttributeType($attributeValue, $dto->$attributeName);
				$dto->$attributeName = $attributeValue;
			}
		}
		return $dto;
	}

	public function setDtoClass(string $className): void
	{
		$this->dtoClass = $className;
	}

	private function isAttributeValid($attributeValue, $attributeName, $dto)
	{
		$isValueNotNull = $attributeValue !== null;
		$isAttributeExists = property_exists($dto, $attributeName);
		return $isValueNotNull && $isAttributeExists; 
	}

	private function changeAttributeType(&$attributeValue, $dtoAttributeValue)
	{
		$dtoAttributeType = gettype($dtoAttributeValue);
		settype($attributeValue, $dtoAttributeType);
	}
}
