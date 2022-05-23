<?php

namespace domain\scientificWork;

class UpdateRequestFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): UpdateDto
	{
		$dto = new UpdateDto();
		$dto->id = $this->queryParams['id'] ?? null;
		$dto->description = $this->bodyParams['description'] ?? null;
		$dto->level = $this->bodyParams['level'] ?? null;
		$dto->teacher_id = $this->bodyParams['teacher_id'] ?? null;
		$dto->type_id = $this->bodyParams['type_id'] ?? null;
		return $dto;
	}
}