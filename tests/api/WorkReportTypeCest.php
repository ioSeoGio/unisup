<?php

use tests\api\common\Cest;

class WorkReportTypeCest extends Cest
{
    public function _fixtures()
    {
        return [
            'users' => [
                'class' => \tests\fixtures\UserFixture::class,
                'dataFile' => codecept_data_dir() . 'users.php',
            ],
            'work_report_types' => [
                'class' => \tests\fixtures\WorkReportTypeFixture::class,
                'dataFile' => codecept_data_dir() . 'work_report_types.php',
            ],
        ];
    }

    public function testIndexAction(ApiTester $I)
    {
        $url = '/admin/work-report-type/index';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url, [
            'description' => 'Выкананне праграмы, па якой універсітэт з ’яўляецца галаўной арганізацыяй (на ўсіх выканаўцаў)',
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
              'description' => 'Выкананне праграмы, па якой універсітэт з ’яўляецца галаўной арганізацыяй (на ўсіх выканаўцаў)',
            ],
        ]);
    }
}
