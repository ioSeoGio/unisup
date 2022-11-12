<?php declare(strict_types=1);

namespace domain\semester\factory;

use models\Course;
use models\Semester;

class SemesterFactory
{
    public static function createFromCourse(Course $course): void
    {
        foreach (self::getDataFromCourse($course) as $datum) {
            $semester = new Semester();
            $semester->name = $datum['semesterName'];
            $semester->course_name = $datum['courseName'];
            $semester->save();
        }
    }

    public static function getDataFromCourse(Course $course): array
    {
        $data = [];
        foreach (Semester::SEMESTERS as $semesterName) {
            $data[] = [
                'semesterName' => $semesterName,
                'courseName' => $course->name,
            ];
        }
        return $data;
    }
}
