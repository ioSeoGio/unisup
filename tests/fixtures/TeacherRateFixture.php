<?php declare(strict_types=1);

namespace tests\fixtures;

use domain\teacherRate\factory\TeacherRateFactory;
use models\Teacher;
use models\TeacherRate;
use seog\test\BaseActiveFixture;

class TeacherRateFixture extends BaseActiveFixture
{
    public $modelClass = TeacherRate::class;

    public $depends = [
        TeacherFixture::class,
    ];

    public function getData(): array
    {
        $rates = [];
        foreach (Teacher::find()->each() as $teacher) {
            $rates[] = TeacherRateFactory::getDataFromTeacher($teacher);
        }
        return $rates;
    }
}
