<?php

namespace tests\api\common;

class Cest
{
	protected function testSucceedIfUnauthorized(&$I, string $url, string $httpMethod)
	{
		$I->send($httpMethod, $url);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIsSuccessful();
	}

	protected function testFailedIfUnauthorized(&$I, string $url, string $httpMethod)
	{
		$I->send($httpMethod, $url);
        $I->seeResponseIsJson();
        $I->seeResponseCodeIs(401);
	}

	protected function asAdmin(&$I)
	{
        $I->haveHttpHeader('Authorization', 'Bearer K1t9ek5Y5llzWcqee7G5lL2j9SR1Vj6r_1644828238');
	}
}
