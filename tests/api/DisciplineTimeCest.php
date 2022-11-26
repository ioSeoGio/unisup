<?php declare(strict_types=1);

namespace tests\api;

use ApiTester;
use models\DisciplineTime;
use tests\api\common\Cest;
use tests\fixtures\DisciplineTimeFixture;
use tests\fixtures\TeacherFixture;
use tests\fixtures\UserFixture;

class DisciplineTimeCest extends Cest
{
    public function _fixtures(): array
    {
        return [
            'users' => UserFixture::class,
            'teachers' => TeacherFixture::class,
            'teacher_preferences' => DisciplineTimeFixture::class,
        ];
    }

    public function getAll(ApiTester $I): void
    {
        $url = '/admin/discipline-time/get-all';
        $this->asAdmin($I);
        $I->sendGet($url);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                [
                    'semester' => [
                        'name' => "I",
                    ],
                    'discipline' => [
                        'name' => 'Математический анализ',
                    ],
                    'hours' => 0,
                ],
            ],
        ]);
    }

    public function setAll(ApiTester $I): void
    {
        $record = DisciplineTime::findOne([
            'semester_id' => 1,
            'discipline_id' => 1,
        ]);
        $I->assertEquals(0, $record->hours);

        $url = '/admin/discipline-time/set-all';
        $this->asAdmin($I);
        $I->sendPost($url, [
            [
                'semesterId' => 1,
                'disciplineId' => 1,
                'hours' => 500,
            ],
        ]);
        $I->seeResponseCodeIsSuccessful();

        $record = DisciplineTime::findOne([
            'semester_id' => 1,
            'discipline_id' => 1,
        ]);
        $I->assertEquals(500, $record->hours);
    }
}
