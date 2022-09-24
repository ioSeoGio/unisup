<?php declare(strict_types=1);

namespace tests\api;

use tests\api\common\Cest;
use domain\workReport\WorkReportLevel;

class EducationalWorkCest extends Cest
{
    public function _fixtures()
    {
        return [
            'users' => \tests\fixtures\UserFixture::class,
            'teachers' => \tests\fixtures\TeacherFixture::class,
            'work_report_types' => \tests\fixtures\WorkReportTypeFixture::class,
            'educational_work_reports' => \tests\fixtures\EducationalWorkReportFixture::class,
            'educational_work_report_authors' => \tests\fixtures\EducationalWorkReportAuthorFixture::class,
        ];
    }

    public function testIndexAction(ApiTester $I)
    {
        $url = '/admin/educational-work/index';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
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

    public function testReadAction(ApiTester $I)
    {
        $url = '/admin/educational-work/read?id=1';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'description' => 'Организация и проведение конкурса «Национальное гостеприимство» (расп. №56 от 05.02.2020);',
            ],
        ]);
    }

    public function testCreateAction(ApiTester $I)
    {
        $url = '/admin/educational-work/create';
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
        $url = '/admin/educational-work/update?id=1';
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
        $readUrl = '/admin/educational-work/read?id=1';
        $I->sendGetAsJson($readUrl);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();

        $deleteUrl = '/admin/educational-work/delete?id=1';
        // $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);

        $I->sendPostAsJson($deleteUrl);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();

        $I->sendGetAsJson($readUrl);
        $I->seeResponseCodeIs(404);
    }
}
