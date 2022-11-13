<?php declare(strict_types=1);

namespace domain\teacherRate\setAll;

use domain\teacherRate\Dto;
use models\TeacherRate;

class Action
{
	public function __construct(
	) {}

	public function run(Dto ...$dtos): void
	{
        foreach ($dtos as $dto) {
            $record = TeacherRate::getOne(['teacher_id' => $dto->teacherId]);
            $record->hours = $dto->hours;
            $record->save();
        }
	}
}
