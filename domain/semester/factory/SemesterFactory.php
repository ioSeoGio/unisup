<?php declare(strict_types=1);

namespace domain\semester\factory;

use models\Course;
use models\Semester;

class SemesterFactory
{
    public static function createFromCourse(Course $course): void
    {
        foreach (Semester::SEMESTERS as $semesterName) {
            $semester = new Semester();
            $semester->name = $semesterName;
            $semester->course_name = $course->name;
            $semester->save();
        }
    }
}
