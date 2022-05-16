<?php

namespace tests\unit\factories;

use domain\login\LoginCredentialsDto;
use domain\login\LoginRequestFactory;
use seog\web\RequestAdapterInterface;

class LoginRequestFactoryTest extends \Codeception\Test\Unit
{
    protected function _before()
    {

    }

    public function testmakeDto()
    {
        $data = [
            'username' => 'test-username',
            'password' => 'test-password',
        ];

        $requestStub = \Codeception\Stub::makeEmpty(
            RequestAdapterInterface::class,
            [
                'getQueryParams' => [],
                'getBodyParams' => $data,
            ],
        );

        $factory = new LoginRequestFactory($requestStub);
        $dto = $factory->makeDto();
        $this->assertInstanceOf(LoginCredentialsDto::class, $dto, 'DTO must be instance LoginCredentialsDto');
        $this->assertEquals($dto->username, $data['username'], 'Must be equals');
        $this->assertEquals($dto->password, $data['password'], 'Must be equals');
    }
}
