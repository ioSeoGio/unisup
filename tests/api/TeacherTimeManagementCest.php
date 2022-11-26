<?php declare(strict_types=1);

namespace tests\api;

use ApiTester;
use models\TeacherTimeManagement;
use tests\api\common\Cest;
use tests\fixtures\TeacherFixture;
use tests\fixtures\TeacherTimeManagementFixture;
use tests\fixtures\UserFixture;

class TeacherTimeManagementCest extends Cest
{
    public function _fixtures(): array
    {
        return [
            'users' => UserFixture::class,
            'teachers' => TeacherFixture::class,
            'teacher_preferences' => TeacherTimeManagementFixture::class,
        ];
    }

    public function getAll(ApiTester $I): void
    {
        $url = '/admin/teacher-time-management/get-all';
        $this->asAdmin($I);
        $I->sendGet($url);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'teacher' => [
                    'id' => 1,
                    'full_name' => 'Марзан Сергей Андреевич',
                    'sex' => true,
                    'department_id' => 2,
                    'academic_degree_id' => 1,
                    'academic_title_id' => 1,
                    'teacher_post_id' => 4,
                    'working_since' => '2022-05-06 11:12:15',
                ],
                'discipline' => [
                    'id' => 1,
                    'name' => 'Математический анализ',
                ],
                'semester' => [
                    'name' => 'I',
                ],
                'hours' => 0,
            ],
        ]);
    }

    public function setAll(ApiTester $I): void
    {
        $record = TeacherTimeManagement::findOne([
            'teacher_id' => 1,
            'semester_id' => 1,
            'discipline_id' => 1,
        ]);
        $I->assertEquals(0, $record->hours);

        $url = '/admin/teacher-time-management/set-all';
        $this->asAdmin($I);
        $I->sendPost($url, [
            [
                'teacherId' => 1,
                'semesterId' => 1,
                'disciplineId' => 1,
                'hours' => 102,
            ],
        ]);
        $I->seeResponseCodeIsSuccessful();

        $record = TeacherTimeManagement::findOne([
            'teacher_id' => 1,
            'semester_id' => 1,
            'discipline_id' => 1,
        ]);
        $I->assertEquals(102, $record->hours);
    }
}
