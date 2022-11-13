<?php declare(strict_types=1);

namespace tests\fixtures;

use domain\semester\factory\SemesterFactory;
use models\Course;
use models\Semester;
use seog\test\BaseActiveFixture;

class SemesterFixture extends BaseActiveFixture
{
    public $modelClass = Semester::class;

    public $depends = [
        CourseFixture::class,
    ];

    public function getData(): array
    {
        $semesters = [];
        foreach (Course::find()->each() as $course) {
            $semesters = array_merge($semesters, SemesterFactory::getDataFromCourse($course));
        }
        return $semesters;
    }
}
