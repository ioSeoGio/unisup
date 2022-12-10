<?php declare(strict_types=1);

namespace tests\api;

use ApiTester;
use models\TeacherRate;
use tests\api\common\Cest;
use tests\fixtures\TeacherFixture;
use tests\fixtures\TeacherRateFixture;
use tests\fixtures\UserFixture;

class TeacherRateCest extends Cest
{
    public function _fixtures(): array
    {
        return [
            'users' => UserFixture::class,
            'teachers' => TeacherFixture::class,
            'teacher_rates' => TeacherRateFixture::class,
        ];
    }

    public function getAll(ApiTester $I): void
    {
        $this->asAdmin($I);
        $I->sendGet('/admin/teacher-rate/get-all', [
            'teacherId' => 1,
        ]);
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                [
                    'teacher' => [
                        'id' => 1,
                    ],
                ]
            ]
        ]);
    }

    public function setAll(ApiTester $I): void
    {
        $this->asAdmin($I);
        $I->sendPost('/admin/teacher-rate/set-all', [
            [
                'teacherId' => 1,
                'hours' => 999
            ],
        ]);
        $I->seeResponseCodeIsSuccessful();

        $record = TeacherRate::getOne(['teacher_id' => 1]);
        $I->assertEquals(999, $record->hours);
    }
}
