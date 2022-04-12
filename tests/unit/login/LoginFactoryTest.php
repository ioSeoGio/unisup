<?php

namespace tests\unit\factories;

use Yii;
use domain\login\LoginFactory;
use domain\login\LoginCredentialsDto;
use seog\web\RequestAdapterInterface;

class LoginFactoryTest extends \Codeception\Test\Unit
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
                'getBodyParams' => $data
            ],
        );

        $factory = new LoginFactory($requestStub);
        $dto = $factory->makeDto();
        $this->assertInstanceOf(LoginCredentialsDto::class, $dto, 'DTO must be instance LoginCredentialsDto');
        $this->assertEquals($dto->username, $data['username'], 'Must be equals');
        $this->assertEquals($dto->password, $data['password'], 'Must be equals');
    }
}
