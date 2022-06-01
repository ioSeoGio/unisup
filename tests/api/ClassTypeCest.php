<?php

use tests\api\common\Cest;

class ClassTypeCest extends Cest
{
    public function _fixtures()
    {
        return [
            'users' => \tests\fixtures\UserFixture::class,
            'class-types' => \tests\fixtures\ClassTypeFixture::class,
        ];
    }

    public function testIndexAction(ApiTester $I)
    {
        $url = '/admin/class-type/index';
        // $this->testFailedIfUnauthorized($I, $url, 'GET');
        $this->asAdmin($I);
        $I->sendGetAsJson($url, [
            'name' => 'Лекция',
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
                'name' => 'Лекция',
            ],
        ]);
    }
}
