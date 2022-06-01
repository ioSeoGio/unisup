<?php

use tests\api\common\Cest;
use domain\workReport\WorkReportLevel;

class MethodicalWorkCest extends Cest
{
    public function _fixtures()
    {
        return [
            'users' => \tests\fixtures\UserFixture::class,
            'teachers' => \tests\fixtures\TeacherFixture::class,
            'work_report_types' => \tests\fixtures\WorkReportTypeFixture::class,
            'methodical_work_reports' => \tests\fixtures\MethodicalWorkReportFixture::class,
            'methodical_work_report_authors' => \tests\fixtures\MethodicalWorkReportAuthorFixture::class,
        ];
    }

    public function testIndexAction(ApiTester $I)
    {
        $url = '/admin/methodical-work/index';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url, [
            'description' => 'Математический анализ (2014)',
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
              'id' => 1,
              'description' => 'Математический анализ (2014): учеб. пособие: в 4 ч. / Н.П. Семенчук, Н.Н. Сендер, С.А. Марзан, А. Н. Сендер, под общ. ред. Н.Н. Сендера ; Брест. гос. ун-т им. А. С. Пушкина. – Брест: БрГУ, 2020. – Ч. 3: Дифференциальное и интегральное исчисление функций многих переменных: в 2 кн. – кн. 1. – 226 с. (гриф Министерства образования Республики Беларусь)',
            ],
        ]);
    }

    public function testReadAction(ApiTester $I)
    {
        $url = '/admin/methodical-work/read?id=1';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'description' => 'Математический анализ (2014): учеб. пособие: в 4 ч. / Н.П. Семенчук, Н.Н. Сендер, С.А. Марзан, А. Н. Сендер, под общ. ред. Н.Н. Сендера ; Брест. гос. ун-т им. А. С. Пушкина. – Брест: БрГУ, 2020. – Ч. 3: Дифференциальное и интегральное исчисление функций многих переменных: в 2 кн. – кн. 1. – 226 с. (гриф Министерства образования Республики Беларусь)',
            ],
        ]);
    }

    public function testCreateAction(ApiTester $I)
    {
        $url = '/admin/methodical-work/create';
        // $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);
        $I->sendPostAsJson($url, [
            'description' => 'test-description',
            'level' => WorkReportLevel::BREST,
            'type_id' => 5,
            'teachers' => [1],
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'description' => 'test-description',
                'level' => WorkReportLevel::BREST,
                'type_id' => 5,
            ]
        ]);
    }

    public function testUpdateActionOneField(ApiTester $I)
    {
        $url = '/admin/methodical-work/update?id=1';
        // $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);

        $I->sendPostAsJson($url, ['description' => 'test-description-updated']);
        
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'id' => 1,
                'description' => 'test-description-updated',
            ]
        ]);
    }

    public function testDeleteAction(ApiTester $I)
    {
        $readUrl = '/admin/methodical-work/read?id=1';
        $I->sendGetAsJson($readUrl);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();

        $deleteUrl = '/admin/methodical-work/delete?id=1';
        // $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);

        $I->sendPostAsJson($deleteUrl);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();

        $I->sendGetAsJson($readUrl);
        $I->seeResponseCodeIs(404);
    }
}
