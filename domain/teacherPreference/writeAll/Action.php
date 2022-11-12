<?php declare(strict_types=1);

namespace domain\teacherPreference\writeAll;

use models\TeacherPreference;

class Action
{
	public function __construct(
	) {}

	public function run(Dto ...$dtos): void
	{
        foreach ($dtos as $dto) {
            $record = TeacherPreference::findOne([
                'teacher_id' => $dto->teacherId,
                'discipline_id' => $dto->disciplineId,
                'semester_id' => $dto->semesterId,
            ]);
            $record->importance_coefficient = $dto->importanceCoefficient;
            $record->save();
        }
	}
}
