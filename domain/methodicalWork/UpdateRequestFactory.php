<?php declare(strict_types=1);

namespace domain\methodicalWork;

class UpdateRequestFactory extends \factories\RequestFactory
{
	public function makeDto(): UpdateDto
	{
		$dto = new UpdateDto();
		$dto->id = (int) $this->queryParams['id'] ?? null;
		$dto->description = $this->bodyParams['description'] ?? null;
		$dto->level = $this->bodyParams['level'] ?? null;
		$dto->type_id = $this->bodyParams['type_id'] ?? null;
		return $dto;
	}
}
