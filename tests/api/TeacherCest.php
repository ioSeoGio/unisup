<?php

use tests\api\common\Cest;

class TeacherCest extends Cest
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
        ];
    }

    public function testIndexAction(ApiTester $I)
    {
        $url = '/admin/teacher/index';
        $this->testFailedIfUnauthorized($I, $url, 'GET');
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
