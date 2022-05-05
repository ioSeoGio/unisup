<?php

namespace tests\unit\data;

use domain\user\UserDeleter;
use domain\user\UserRepository;
use models\User;
use seog\db\ActiveQueryAdapter;

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
        $query = new ActiveQueryAdapter(User::class);

        $this->deleter = new UserDeleter($query);
        $this->repository = new UserRepository($query);
    }

    public function testDeleteOneById()
    {
        $this->assertTrue($this->deleter->deleteOneById(2));
        $null = $this->repository->findOneById(2);
        $this->assertNull($null);
    }
}
