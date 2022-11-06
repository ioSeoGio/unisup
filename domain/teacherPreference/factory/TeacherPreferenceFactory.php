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
        foreach (Semester::find()->each() as $semester) {
            foreach (Discipline::find()->each() as $discipline) {
                $preference = new TeacherPreference();
                $preference->teacher_id = $teacher->id;
                $preference->discipline_id = $discipline->id;
                $preference->semester_id = $semester->id;
                $preference->save();
            }
        }
    }
}
