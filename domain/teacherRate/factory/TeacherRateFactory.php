<?php declare(strict_types=1);

namespace domain\teacherRate\factory;

use models\Teacher;
use models\TeacherRate;

class TeacherRateFactory
{
    public static function createOneFromTeacher(Teacher $teacher): void
    {
        foreach (self::getDataFromTeacher($teacher) as $datum) {
            $rate = new TeacherRate([
                'teacher_id' => $datum['teacher_id'],
            ]);
            $rate->save();
        }
    }

    public static function getDataFromTeacher(Teacher $teacher, bool $generateRandomHours = false): array
    {
        return [
            'teacher_id' => $teacher->id,
            'hours' => $generateRandomHours ? rand(1, 50) * 10 : 0,
            'hours_left' => $generateRandomHours ? rand(1, 50) * 10 : 0,
        ];
    }
}
