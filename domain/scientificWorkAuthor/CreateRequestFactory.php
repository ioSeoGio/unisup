<?php declare(strict_types=1);

namespace domain\scientificWorkAuthor;

class CreateRequestFactory extends \factories\RequestFactory
{
	public function makeDto(): Dto
	{
		$dto = new Dto();
		$dto->teacher_id = $this->bodyParams['teacher_id'] ?? null;
		$dto->work_report_id = $this->bodyParams['work_report_id'] ?? null;
		return $dto;
	}
}
