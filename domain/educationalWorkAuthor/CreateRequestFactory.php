<?php

namespace domain\educationalWorkAuthor;

class CreateRequestFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): Dto
	{
		$dto = new Dto();
		$dto->teacher_id = $this->bodyParams['teacher_id'] ?? null;
		$dto->work_report_id = $this->bodyParams['work_report_id'] ?? null;
		return $dto;
	}
}