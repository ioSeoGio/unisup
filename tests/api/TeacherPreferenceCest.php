<?php declare(strict_types=1);

namespace tests\api;

use ApiTester;
use models\TeacherPreference;
use tests\api\common\Cest;
use tests\fixtures\TeacherFixture;
use tests\fixtures\TeacherPreferenceFixture;
use tests\fixtures\UserFixture;

class TeacherPreferenceCest extends Cest
{
    public function _fixtures(): array
    {
        return [
            'users' => UserFixture::class,
            'teachers' => TeacherFixture::class,
            'teacher_preferences' => TeacherPreferenceFixture::class,
        ];
    }

    public function getAll(ApiTester $I): void
    {
        $url = '/admin/teacher-preference/get-all';
        $this->asAdmin($I);
        $I->sendGet($url, [
            'teacher_name' => 'Марзан Сергей Андреевич',
            'discipline_name' => 'Математический анализ',
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                [
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
                ]
            ],
        ]);
    }

    public function setAll(ApiTester $I): void
    {
        $url = '/admin/teacher-preference/set-all';
        $this->asAdmin($I);
        $I->sendPost($url, [
            [
                'teacherId' => 1,
                'semesterId' => 1,
                'disciplineId' => 1,
                'importanceCoefficient' => 99,
            ],
        ]);
        $I->seeResponseCodeIsSuccessful();

        $record = TeacherPreference::findOne([
            'teacher_id' => 1,
            'semester_id' => 1,
            'discipline_id' => 1,
        ]);
        $I->assertEquals(99, $record->importance_coefficient);
    }
}
