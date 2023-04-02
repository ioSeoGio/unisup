<?php declare(strict_types=1);

namespace domain\disciplineTime\factory;

use models\Discipline;
use models\DisciplineTime;
use models\Semester;

class DisciplineTimeFactory
{
    public static function createManyFromDiscipline(Discipline $discipline): void
    {
        foreach (self::getDataFromDiscipline($discipline) as $datum) {
            $model = new DisciplineTime();
            $model->discipline_id = $datum['discipline_id'];
            $model->semester_id = $datum['semester_id'];
            $model->save();
        }
    }

    public static function getDataFromDiscipline(Discipline $discipline, bool $generateRandomHours = false): array
    {
        $data = [];
        foreach (Semester::find()->each() as $semester) {
            $data[] = [
                'discipline_id' => $discipline->id,
                'semester_id' => $semester->id,
                'hours' => $generateRandomHours ? rand(2, 50) * 10 : 0,
            ];
        }
        return $data;
    }
}
