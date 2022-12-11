<?php declare(strict_types=1);

namespace tests\fixtures;

use domain\teacherTimeManagement\factory\TeacherTimeManagementFactory;
use models\Teacher;
use models\TeacherTimeManagement;
use seog\test\BaseActiveFixture;

class TeacherTimeManagementFixture extends BaseActiveFixture
{
    public $modelClass = TeacherTimeManagement::class;

    public $depends = [
        SemesterFixture::class,
        DisciplineFixture::class,
        TeacherFixture::class,
        DisciplineTimeFixture::class,
        TeacherRateFixture::class,
        TeacherPreferenceFixture::class,
    ];

    public function getData(): array
    {
        $timeManagements = [];
        foreach (Teacher::find()->each() as $teacher) {
            $timeManagements = array_merge($timeManagements, TeacherTimeManagementFactory::getDataFromTeacher($teacher));
        }
        return $timeManagements;
    }
}
