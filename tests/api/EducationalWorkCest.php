<?php

use tests\api\common\Cest;
use domain\workReport\WorkReportLevel;

class EducationalWorkCest extends Cest
{
    public function testIndexAction(ApiTester $I)
    {
        $url = '/admin/educational-work/index';
        $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url, [
            'description' => 'матча по мини-футболу',
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
              'id' => 2,
              'description' => 'Организация факультетского матча по мини-футболу между командой студентов 1 курса и командой старшекурсников физико-математического факультета; по баскетболу между командой преподавателей и студентов 30.10.2020 в 20.30 в спортивном зале Сендер А.Н. (расп. 223 от 08.10.2020);',
            ],
        ]);
    }

    public function testCreateAction(ApiTester $I)
    {
        $url = '/admin/educational-work/create';
        $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);
        $data = [
            'description' => 'test-description',
            'level' => WorkReportLevel::BREST,
            'teacher_id' => 1,
            'type_id' => 5,
        ];
        $I->sendPostAsJson($url, $data);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => $data
        ]);
    }
}
