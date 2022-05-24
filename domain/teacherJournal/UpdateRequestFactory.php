<?php

namespace domain\teacherJournal;

class UpdateRequestFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): UpdateDto
	{
		$dto = new UpdateDto();
		$dto->id = $this->queryParams['id'] ?? null;
		$dto->name = $this->bodyParams['name'] ?? null;
		$dto->teacher_id = $this->bodyParams['teacher_id'] ?? null;
		$dto->discipline_id = $this->bodyParams['discipline_id'] ?? null;
		return $dto;
	}
}