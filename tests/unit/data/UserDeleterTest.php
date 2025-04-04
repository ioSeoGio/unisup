<?php declare(strict_types=1);

namespace tests\unit\data;

use domain\user\Deleter as UserDeleter;
use domain\user\Repository as UserRepository;

class UserDeleterTest extends \Codeception\Test\Unit
{
    private UserRepository $repository;
    private UserDeleter $deleter;

    public function _fixtures()
    {
        return [
            'users' => [
                'class' => \tests\fixtures\UserFixture::class,
            ],
        ];
    }

    public function _before()
    {
        $this->deleter = \Yii::$container->get(UserDeleter::class);
        $this->repository = \Yii::$container->get(UserRepository::class);
    }

    public function testDeleteOneById()
    {
        $this->assertTrue($this->deleter->deleteOneById(2));
        $null = $this->repository->findOneById(2);
        $this->assertNull($null);
    }
}
