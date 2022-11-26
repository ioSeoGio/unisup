<?php declare(strict_types=1);

namespace tests\fixtures;

use domain\teacherPreference\factory\TeacherPreferenceFactory;
use models\Teacher;
use models\TeacherPreference;
use seog\test\BaseActiveFixture;

class TeacherPreferenceFixture extends BaseActiveFixture
{
    public $modelClass = TeacherPreference::class;

    public $depends = [
        SemesterFixture::class,
        DisciplineFixture::class,
        TeacherFixture::class,
    ];

    public function getData(): array
    {
        $preferences = [];
        foreach (Teacher::find()->each() as $teacher) {
            $preferences = array_merge($preferences, TeacherPreferenceFactory::getDataFromTeacher($teacher));
        }
        return $preferences;
    }
}
