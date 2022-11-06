<?php declare(strict_types=1);

namespace domain\methodicalWork;

class ReadRequestFactory extends \factories\RequestFactory
{
	public function makeDto(): ReadRequestDto
	{
		$dto = new ReadRequestDto();
		$dto->id = (int) $this->queryParams['id'] ?? null;
		return $dto;
	}
}
