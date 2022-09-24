<?php declare(strict_types=1);

use tests\api\common\Cest;

class WorkReportTypeCest extends Cest
{
    public function _fixtures()
    {
        return [
            'users' => \tests\fixtures\UserFixture::class,
            'work_report_types' => \tests\fixtures\WorkReportTypeFixture::class,
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
