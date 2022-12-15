<?php declare(strict_types=1);

namespace domain\disciplineTime\writeAll;

use models\DisciplineTime;

class Action
{
	public function __construct(
	) {}

	public function run(Dto ...$dtos): void
	{
        foreach ($dtos as $dto) {
            $record = DisciplineTime::getOne([
                'discipline_id' => $dto->disciplineId,
                'semester_id' => $dto->semesterId,
            ]);
            $record->hours = $dto->hours;
            $record->saveAndThrowOnError();
        }
	}
}
