<?php

namespace tests\unit\factories;

use Yii;
use domain\login\LoginFactory;
use domain\login\LoginCredentialsDTO;
use seog\web\RequestAdapterInterface;

class LoginFactoryTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
        
    }

    public function testMakeDTO()
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
        $dto = $factory->makeDTO();

        $this->assertTrue($dto instanceof LoginCredentialsDTO, 'DTO must be instance LoginCredentialsDTO');
        $this->assertTrue($dto->username === $data['username'], 'Must be equals');
        $this->assertTrue($dto->password === $data['password'], 'Must be equals');
    }
}
