<?php

namespace tests\unit\data;

use domain\user\UserDeleter;
use domain\user\UserDTO;
use domain\user\UserRepository;
use factories\DataFactory;
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
        $factory = new DataFactory(UserDTO::class);

        $this->deleter = new UserDeleter($query);
        $this->repository = new UserRepository($query, $factory);
    }

    public function testDeleteOneById()
    {
        $this->assertTrue($this->deleter->deleteOneById(2));
        $emptyDTO = $this->repository->findOneById(2);
        $this->assertNull($emptyDTO);
    }
}
