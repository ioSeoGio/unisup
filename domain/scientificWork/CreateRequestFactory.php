<?php

namespace domain\scientificWork;

class CreateRequestFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): Dto
	{
		$dto = new Dto();
		$dto->description = $this->bodyParams['description'] ?? null;
		$dto->level = $this->bodyParams['level'] ?? null;
		$dto->type_id = $this->bodyParams['type_id'] ?? null;
		$dto->teachers = $this->bodyParams['teachers'] ?? null;
		return $dto;
	}
}