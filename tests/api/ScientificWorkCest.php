<?php declare(strict_types=1);

namespace tests\api;

use ApiTester;
use tests\api\common\Cest;
use domain\workReport\WorkReportLevel;

class ScientificWorkCest extends Cest
{
    public function _fixtures(): array
    {
        return [
            'users' => \tests\fixtures\UserFixture::class,
            'teachers' => \tests\fixtures\TeacherFixture::class,
            'work_report_types' => \tests\fixtures\WorkReportTypeFixture::class,
            'scientific_work_reports' => \tests\fixtures\ScientificWorkReportFixture::class,
            'scientific_work_report_authors' => \tests\fixtures\ScientificWorkReportAuthorFixture::class,
        ];
    }

    public function testIndexAction(ApiTester $I): void
    {
        $url = '/admin/scientific-work/index';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url, [
            'description' => 'Сендер, А.Н. Объектно-ориентированное программирование в PHP',
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'id' => 2,
                'description' => 'Сендер, А.Н. Объектно-ориентированное программирование в PHP / Е.К. Пархоц, А.Н. Сендер // Математическое моделирование и новые образовательные технологии в математике: сб. тезисов. Респ. науч.-практ. конф., Брест, 23–24 апр. 2020 г. / Брест. гос. ун-т им. А. С. Пушкина; под общ. ред. А. И. Басика. – Брест: БрГУ, 2020. – С. 4.',
            ],
        ]);
    }

    public function testReadAction(ApiTester $I): void
    {
        $url = '/admin/scientific-work/read?id=2';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'description' => 'Сендер, А.Н. Объектно-ориентированное программирование в PHP / Е.К. Пархоц, А.Н. Сендер // Математическое моделирование и новые образовательные технологии в математике: сб. тезисов. Респ. науч.-практ. конф., Брест, 23–24 апр. 2020 г. / Брест. гос. ун-т им. А. С. Пушкина; под общ. ред. А. И. Басика. – Брест: БрГУ, 2020. – С. 4.',
            ],
        ]);
    }

    public function testCreateAction(ApiTester $I): void
    {
        $url = '/admin/scientific-work/create';
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

    public function testUpdateAction(ApiTester $I): void
    {
        $url = '/admin/scientific-work/update?id=1';
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

    public function testDeleteAction(ApiTester $I): void
    {
        $readUrl = '/admin/scientific-work/read?id=1';
        $I->sendGetAsJson($readUrl);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        
        $url = '/admin/scientific-work/delete?id=1';
        // $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);

        $I->sendPostAsJson($url);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();

        $I->sendGetAsJson($readUrl);
        $I->seeResponseCodeIs(404);
    }
}
