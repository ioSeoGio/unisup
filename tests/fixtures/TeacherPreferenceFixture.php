<?php declare(strict_types=1);

namespace tests\fixtures;

use domain\teacherPreference\factory\TeacherPreferenceFactory;
use models\Discipline;
use models\Semester;
use models\Teacher;
use seog\test\BaseActiveFixture;

class TeacherPreferenceFixture extends BaseActiveFixture
{
    public $modelClass = 'models\TeacherPreference';

    public $depends = [
        SemesterFixture::class,
        DisciplineFixture::class,
        TeacherFixture::class,
    ];

    public function getData(): array
    {
        $preferences = [];
        foreach (Teacher::find()->each() as $teacher) {
            $preferences[] = TeacherPreferenceFactory::getDataFromTeacher($teacher);
        }
        return $preferences;
    }
}
