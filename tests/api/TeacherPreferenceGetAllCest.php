<?php declare(strict_types=1);

namespace tests\api;

use ApiTester;
use models\Teacher;
use models\TeacherPreference;
use tests\api\common\Cest;
use tests\fixtures\MethodicalWorkReportAuthorFixture;
use tests\fixtures\MethodicalWorkReportFixture;
use tests\fixtures\TeacherFixture;
use tests\fixtures\UserFixture;
use tests\fixtures\WorkReportTypeFixture;

class TeacherPreferenceGetAllCest extends Cest
{
    public function _fixtures(): array
    {
        return [
            'users' => UserFixture::class,
            'teachers' => TeacherFixture::class,
            'work_report_types' => WorkReportTypeFixture::class,
            'methodical_work_reports' => MethodicalWorkReportFixture::class,
            'methodical_work_report_authors' => MethodicalWorkReportAuthorFixture::class,
        ];
    }

    public function successful(ApiTester $I): void
    {
        $url = '/admin/teacher-preference/get-all';
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
                'discipline' => null,
                'importance_coefficient' => 0
            ],
        ]);
    }
}
