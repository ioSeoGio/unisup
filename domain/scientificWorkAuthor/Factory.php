<?php

namespace domain\scientificWorkAuthor;

class Factory
{
	public static function makeDto(
		int $teacher_id,
		int $work_report_id
	): Dto
	{
		$dto = new Dto();
		$dto->teacher_id = $teacher_id;
		$dto->work_report_id = $work_report_id;
		return $dto;
	}
}