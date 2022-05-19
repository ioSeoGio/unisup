<?php

namespace tests\unit\data;

use domain\user\Deleter as UserDeleter;
use domain\user\Repository as UserRepository;

class UserDeleterTest extends \Codeception\Test\Unit
{
    private $repository;
    private $deleter;

    public function _fixtures()
    {
        return [
            'users' => [
                'class' => \tests\fixtures\UserFixture::class,
                'dataFile' => codecept_data_dir() . 'users.php',
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
