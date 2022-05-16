<?php

namespace domain\educationalWork;

class EducationalWorkRequestFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): EducationalWorkRequestDto
	{
		$dto = new EducationalWorkRequestDto();
		$dto->documentHeaderString = $this->queryParams['document_header'];
		$dto->teacherId = $this->queryParams['teacher_id'];
		return $dto;
	}
}