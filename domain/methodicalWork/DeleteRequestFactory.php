<?php declare(strict_types=1);

namespace domain\methodicalWork;

class DeleteRequestFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): DeleteRequestDto
	{
		$dto = new DeleteRequestDto();
		$dto->id = $this->queryParams['id'] ?? null;
		return $dto;
	}
}