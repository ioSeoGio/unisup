<?php declare(strict_types=1);

namespace tests\api;

use ApiTester;
use tests\api\common\Cest;
use tests\fixtures\MethodicalWorkReportAuthorFixture;
use tests\fixtures\MethodicalWorkReportFixture;
use tests\fixtures\TeacherFixture;
use tests\fixtures\UserFixture;
use tests\fixtures\WorkReportTypeFixture;

class TeacherPreferenceGetAllCest extends Cest
{
    public function _fixtures()
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
                'id' => 1,
                'description' => 'Математический анализ (2014): учеб. пособие: в 4 ч. / Н.П. Семенчук, Н.Н. Сендер, С.А. Марзан, А. Н. Сендер, под общ. ред. Н.Н. Сендера ; Брест. гос. ун-т им. А. С. Пушкина. – Брест: БрГУ, 2020. – Ч. 3: Дифференциальное и интегральное исчисление функций многих переменных: в 2 кн. – кн. 1. – 226 с. (гриф Министерства образования Республики Беларусь)',
            ],
        ]);
    }
}
