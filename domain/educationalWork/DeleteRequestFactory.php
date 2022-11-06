<?php declare(strict_types=1);

namespace domain\educationalWork;

class DeleteRequestFactory extends \factories\RequestFactory
{
	public function makeDto(): DeleteRequestDto
	{
		$dto = new DeleteRequestDto();
		$dto->id = (int) $this->queryParams['id'] ?? null;
		return $dto;
	}
}
