<?php declare(strict_types=1);

namespace domain\journal;

class CreateRequestFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): Dto
	{
		$dto = new Dto();
		$dto->name = $this->bodyParams['name'] ?? null;
		$dto->teacher_id = $this->bodyParams['teacher_id'] ?? null;
		$dto->discipline_id = $this->bodyParams['discipline_id'] ?? null;
		return $dto;
	}
}