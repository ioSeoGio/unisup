<?php

namespace domain\educationalWork;

class CreateRequestFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): CreateRequestDto
	{
		$dto = new CreateRequestDto();
		$dto->description = $this->bodyParams['description'] ?? null;
		$dto->level = $this->bodyParams['level'] ?? null;
		$dto->teacher_id = $this->bodyParams['teacher_id'] ?? null;
		$dto->type_id = $this->bodyParams['type_id'] ?? null;
		return $dto;
	}
}