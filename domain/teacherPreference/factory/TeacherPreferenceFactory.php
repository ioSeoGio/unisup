<?php declare(strict_types=1);

namespace domain\teacherPreference\factory;

use models\Discipline;
use models\Semester;
use models\Teacher;
use models\TeacherPreference;

class TeacherPreferenceFactory
{
    public static function createManyFromTeacher(Teacher $teacher): void
    {
        foreach (self::getDataFromTeacher($teacher) as $datum) {
            $preference = new TeacherPreference();
            $preference->teacher_id = $datum['teacherId'];
            $preference->discipline_id = $datum['disciplineId'];
            $preference->semester_id = $datum['semesterId'];
            $preference->save();
        }
    }

    public static function getDataFromTeacher(Teacher $teacher): array
    {
        $data = [];
        foreach (Semester::find()->each() as $semester) {
            foreach (Discipline::find()->each() as $discipline) {
                $data[] = [
                    'teacherId' => $teacher->id,
                    'disciplineId' => $discipline->id,
                    'semesterId' => $semester->id,
                ];
            }
        }
        return $data;
    }
}
