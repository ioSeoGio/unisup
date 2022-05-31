<?php

class LoginCest
{
    public function _fixtures()
    {
        return [
            'users' => [
                'class' => \tests\fixtures\UserFixture::class,
            ],
        ];
    }

    public function testSuccessLogin(ApiTester $I)
    {
        $I->sendPostAsJson('/site/login', [
            'username' => 'admin',
            'password' => '12345678',
        ]);
        
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContainsJson([
            'data' => [
              'access_token' => 'K1t9ek5Y5llzWcqee7G5lL2j9SR1Vj6r_1644828238',
            ],
        ]);
    }

    public function testFailedLogin(ApiTester $I)
    {
        $I->sendPostAsJson('/site/login', [
            'username' => 'admin',
            'password' => 'not-correct-password',
        ]);

        $I->seeResponseIsJson();
        $I->seeResponseCodeIsClientError();
    }
}
