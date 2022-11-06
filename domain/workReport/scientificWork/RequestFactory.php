<?php declare(strict_types=1);

namespace domain\workReport\scientificWork;

class RequestFactory extends \factories\RequestFactory
{
	public function makeDto(): RequestDto
	{
		$dto = new RequestDto();
		$dto->documentHeaderString = $this->queryParams['document_header'];
		$dto->teacherId = $this->queryParams['teacher_id'];
		return $dto;
	}
}
