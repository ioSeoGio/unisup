<?php declare(strict_types=1);

namespace domain\teacherTimeManagement\service;

use models\DisciplineTime;
use models\TeacherPreference;
use models\TeacherTimeManagement;

/**
 * Производит вычисления с упором на отдачу всего времени предмета первому преподавателю по приоритету,
 * пока у дисциплины есть часы в семестре.
 *
 * Если часы дисциплины закончились - берем следующую дисциплину.
 * Если часы преподавателя закончились - берем следующего преподавателя.
 *
 * Не пилим часы дисциплины по частям между преподавателями без крайней необходимости.
 */
class SimpleTimeManagementCalculator extends AbstractTimeManagementCalculator
{
    public function calculate(): void
    {
        $this->initCalculatorData();

        $disciplineTimes = DisciplineTime::find()->each();

        foreach ($disciplineTimes as $disciplineTime) {
            $this->assignDisciplineHoursToTeachers($disciplineTime);
        }
    }

    private function assignDisciplineHoursToTeachers(DisciplineTime $disciplineTime): void
    {
        $disciplineHoursLeft = $disciplineTime->hours;
        $teacherPreferences = TeacherPreference::getByDisciplineTimeAndOrderedByImportance($disciplineTime)->each();

        /** @var TeacherPreference $teacherPreference */
        foreach ($teacherPreferences as $teacherPreference) {
            $disciplineHoursLeft = $this->countAndSaveHoursForGivenPreference(
                $teacherPreference,
                $disciplineHoursLeft
            );

            if ($disciplineHoursLeft <= self::HOURS_ACCURACY) {
                break;
            }
        }
    }

    private function countAndSaveHoursForGivenPreference(
        TeacherPreference $teacherPreference,
        float $disciplineHoursLeft
    ): float {
        $teacherRate = $teacherPreference->teacherRate;
        $teacherHoursLeft = $teacherRate->hours;

        if ($disciplineHoursLeft >= $teacherHoursLeft) {
            $hoursTaken = $teacherHoursLeft;
            $teacherHoursLeft = 0;

            $disciplineHoursLeft -= $hoursTaken;
        } else {
            $hoursTaken = $disciplineHoursLeft;
            $disciplineHoursLeft = 0;

            $teacherHoursLeft -= $hoursTaken;
        }

        $teacherRate->hours_left = $teacherHoursLeft;
        $teacherRate->saveAndThrowOnError();
        TeacherTimeManagement::updateWithGivenPreferenceAndHours($teacherPreference, $hoursTaken);

        return $disciplineHoursLeft;
    }
}
