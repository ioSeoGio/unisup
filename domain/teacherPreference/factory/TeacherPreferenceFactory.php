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
            $preference->teacher_id = $datum['teacher_id'];
            $preference->discipline_id = $datum['discipline_id'];
            $preference->semester_id = $datum['semester_id'];
            $preference->save();
        }
    }

    public static function getDataFromTeacher(Teacher $teacher): array
    {
        $data = [];
        foreach (Semester::find()->each() as $semester) {
            foreach (Discipline::find()->each() as $discipline) {
                $data[] = [
                    'teacher_id' => $teacher->id,
                    'discipline_id' => $discipline->id,
                    'semester_id' => $semester->id,
                ];
            }
        }
        return $data;
    }
}
