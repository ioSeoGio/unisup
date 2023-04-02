<?php declare(strict_types=1);

namespace domain\teacherTimeManagement\setAll;

use domain\teacherTimeManagement\Dto;
use models\TeacherTimeManagement;

class Action
{
	public function __construct(
	) {}

	public function run(Dto ...$dtos): void
	{
        foreach ($dtos as $dto) {
            $record = TeacherTimeManagement::getOrCreateOne([
                'semester_id' => $dto->semesterId,
                'discipline_id' => $dto->disciplineId,
                'teacher_id' => $dto->teacherId,
            ]);
            $record->setHours($dto->hours);
            $record->save();
        }
	}
}
