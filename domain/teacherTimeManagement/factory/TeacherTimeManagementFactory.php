<?php declare(strict_types=1);

namespace domain\teacherTimeManagement\factory;

use models\Discipline;
use models\Semester;
use models\Teacher;
use models\TeacherRate;

class TeacherTimeManagementFactory
{
    public static function createOneFromTeacher(Teacher $teacher): void
    {
        foreach (self::getDataFromTeacher($teacher) as $datum) {
            $timeManagement = new TeacherRate([
                'semester_id' => $datum['semester_id'],
                'discipline_id' => $datum['discipline_id'],
                'teacher_id' => $datum['teacher_id'],
            ]);
            $timeManagement->save();
        }
    }

    public static function getDataFromTeacher(Teacher $teacher): array
    {
        $data = [];
        foreach (Semester::find()->each() as $semester) {
            foreach (Discipline::find()->each() as $discipline) {
                $data[] = [
                    'semester_id' => $semester->id,
                    'discipline_id' => $discipline->id,
                    'teacher_id' => $teacher->id,
                ];
            }
        }
        return $data;
    }
}
