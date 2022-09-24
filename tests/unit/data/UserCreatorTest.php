<?php declare(strict_types=1);

namespace tests\unit\data;

use domain\user\Creator as UserCreator;

class UserCreatorTest extends \Codeception\Test\Unit
{
    private $creator;

    public function _fixtures()
    {
        return [
            'users' => [
                'class' => \tests\fixtures\UserFixture::class,
            ],
        ];
    }

    protected function _before()
    {
        $this->creator = \Yii::$container->get(UserCreator::class);
    }

    public function testCreate()
    {
        $dto = $this->creator
            ->create([
                'username' => 'test_username',
                'password' => '12345678',
                'email' => 'test@gmail.com',
                'access_token' => 'test_3534535',
            ]);
        $this->assertIsObject($dto);
        $this->assertEquals($dto->username, 'test_username');
    }

    public function testCreateMany()
    {
        $dtos = $this->creator
            ->createMany([
                [
                    'username' => 'test_1',
                    'password' => '12345678',
                    'email' => 'test1@gmail.com',
                    'access_token' => 'test_1',
                ],
                [
                    'username' => 'test_2',
                    'password' => '12345678',
                    'email' => 'test2@gmail.com',
                    'access_token' => 'test_2',
                ],
            ]);
        $this->assertIsArray($dtos);
        $this->assertIsObject($dtos[0]);
        $this->assertIsObject($dtos[1]);
        $this->assertEquals($dtos[0]->username, 'test_1');
        $this->assertEquals($dtos[1]->username, 'test_2');
    }
}
