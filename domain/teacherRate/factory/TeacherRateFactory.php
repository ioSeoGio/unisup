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

    public static function getDataFromTeacher(Teacher $teacher): array
    {
        return [
            'teacher_id' => $teacher->id,
        ];
    }
}
