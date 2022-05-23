<?php

namespace domain\scientificWork;

class ReadRequestFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): ReadRequestDto
	{
		$dto = new ReadRequestDto();
		$dto->id = $this->queryParams['id'] ?? null;
		return $dto;
	}
}