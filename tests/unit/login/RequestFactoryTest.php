<?php declare(strict_types=1);

namespace tests\unit\login;

use Codeception\Stub;
use domain\login\LoginCredentialsDto;
use factories\RequestFactory;
use seog\web\RequestAdapterInterface;

class RequestFactoryTest extends \Codeception\Test\Unit
{
    public function testMakeDto()
    {
        $data = [
            'username' => 'test-username',
            'password' => 'test-password',
        ];

        $requestStub = Stub::makeEmpty(
            RequestAdapterInterface::class,
            [
                'getQueryParams' => [],
                'getBodyParams' => $data,
            ],
        );

        $factory = new RequestFactory($requestStub);
        $dto = $factory->makeDto(LoginCredentialsDto::class);
        $this->assertInstanceOf(LoginCredentialsDto::class, $dto, 'DTO must be instance LoginCredentialsDto');
        $this->assertEquals($dto->username, $data['username']);
        $this->assertEquals($dto->password, $data['password']);
    }
}
