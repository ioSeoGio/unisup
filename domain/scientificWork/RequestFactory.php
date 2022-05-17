<?php

namespace domain\scientificWork;

class RequestFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): RequestDto
	{
		$dto = new RequestDto();
		$dto->documentHeaderString = $this->queryParams['document_header'];
		$dto->teacherId = $this->queryParams['teacher_id'];
		return $dto;
	}
}