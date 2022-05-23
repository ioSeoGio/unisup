<?php

use tests\api\common\Cest;
use domain\workReport\WorkReportLevel;

class ScientificWorkCest extends Cest
{
    public function _fixtures()
    {
        return [
            'users' => [
                'class' => \tests\fixtures\UserFixture::class,
                'dataFile' => codecept_data_dir() . 'users.php',
            ],
            'teachers' => [
                'class' => \tests\fixtures\TeacherFixture::class,
                'dataFile' => codecept_data_dir() . 'teachers.php',
            ],
            'work_report_types' => [
                'class' => \tests\fixtures\WorkReportTypeFixture::class,
                'dataFile' => codecept_data_dir() . 'work_report_types.php',
            ],
            'scientific_work_reports' => [
                'class' => \tests\fixtures\ScientificWorkReportFixture::class,
                'dataFile' => codecept_data_dir() . 'scientific_work_reports.php',
            ],
            'scientific_work_report_authors' => [
                'class' => \tests\fixtures\ScientificWorkReportAuthorFixture::class,
                'dataFile' => codecept_data_dir() . 'scientific_work_report_authors.php',
            ],
        ];
    }

    public function testIndexAction(ApiTester $I)
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

    public function testReadAction(ApiTester $I)
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

    public function testCreateAction(ApiTester $I)
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

    public function testUpdateActionOneField(ApiTester $I)
    {
        $url = '/admin/scientific-work/update?id=1';
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
        $url = '/admin/scientific-work/delete?id=1';
        // $this->testFailedIfUnauthorized($I, $url, 'POST');
        $this->asAdmin($I);

        $I->sendPostAsJson($url);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();

        $I->sendGetAsJson('/admin/scientific-work/read?id=1');
        $I->seeResponseCodeIs(404);
    }
}
