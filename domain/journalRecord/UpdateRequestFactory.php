<?php

namespace domain\journalRecord;

class UpdateRequestFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): UpdateDto
	{
		$dto = new UpdateDto();
		$dto->id = $this->queryParams['id'] ?? null;
		$dto->topic = $this->bodyParams['topic'] ?? null;
		$dto->class_type = $this->bodyParams['class_type'] ?? null;
		$dto->journal_id = $this->bodyParams['journal_id'] ?? null;
		$dto->teacher_id = $this->bodyParams['teacher_id'] ?? null;
		$dto->group_id = $this->bodyParams['group_id'] ?? null;
		$dto->lesson_at = $this->bodyParams['lesson_at'] ?? null;
		return $dto;
	}
}