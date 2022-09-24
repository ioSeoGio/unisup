<?php declare(strict_types=1);

use tests\api\common\Cest;

class TeacherCest extends Cest
{
    public function _fixtures()
    {
        return [
            'users' => \tests\fixtures\UserFixture::class,
            'teachers' => \tests\fixtures\TeacherFixture::class,
        ];
    }

    public function testIndexAction(ApiTester $I)
    {
        $url = '/admin/teacher/index';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url, [
            'full_name' => 'Марзан',
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'full_name' => 'Марзан Сергей Андреевич',
            ],
        ]);
    }
}
