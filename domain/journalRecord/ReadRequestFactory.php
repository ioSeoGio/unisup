<?php declare(strict_types=1);

namespace domain\journalRecord;

class ReadRequestFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): ReadRequestDto
	{
		$dto = new ReadRequestDto();
		$dto->id = $this->queryParams['id'] ?? null;
		return $dto;
	}
}