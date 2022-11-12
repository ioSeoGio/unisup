<?php declare(strict_types=1);

namespace tests\api\common;

use seog\web\RequestAdapter;
use seog\web\RequestAdapterInterface;
use Yii;
use yii\web\Request;

class ApiTest extends \Codeception\Test\Unit
{
    public function request(string $url, array $queryParams = [], array $bodyParams = []): mixed
    {
        $request = new RequestAdapter(['queryParams' => $queryParams, 'bodyParams' => $bodyParams]);
        Yii::$container->set(RequestAdapterInterface::class, $request);

        $url = \Yii::$app->urlManager->parseRequest(new Request(['url' => parse_url($url, PHP_URL_PATH)]));
        [$controller, $actionID] = \Yii::$app->createController($url[0]);

        return $controller->run($actionID, $queryParams);
    }

	protected function asAdmin(&$I): void
    {
        $I->haveHttpHeader('Authorization', 'Bearer K1t9ek5Y5llzWcqee7G5lL2j9SR1Vj6r_1644828238');
	}

    protected function assertArrayPartial(array $needle, array $haystack): void
    {
        foreach ($needle as $key => $value) {
            $this->assertArrayHasKey($key, $haystack);
            $this->assertEquals($value, $haystack[$key]);
        }
    }
}
