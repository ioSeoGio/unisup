<?php declare(strict_types=1);

namespace tests\unit\data;

use models\User;
use domain\user\Repository as UserRepository;

class UserRepositoryTest extends \Codeception\Test\Unit
{
    private $repository;

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
        $this->repository = \Yii::$container->get(UserRepository::class);
    }

    public function testSelect()
    {
        $dto = $this->repository
            ->select([UserRepository::PRIMARY_KEY])
            ->one();
        $this->assertIsObject($dto);
        $this->assertNotEquals($dto->id, 0);
        $this->assertEquals($dto->username, '');
    }

    public function testLimit()
    {
        $array = $this->repository
            ->limit(1)
            ->all();
        $this->assertCount(1, $array);
        $this->assertIsArray($array);
        $this->assertIsObject($array[0]);
    }

    public function testOrderBy()
    {
        $array = $this->repository
            ->orderBy(['role' => SORT_ASC])
            ->all();
        $this->assertIsArray($array);
        $this->assertEquals(User::ROLE_USER, $array[0]->role);
        $this->assertEquals(User::ROLE_MODERATOR, $array[1]->role);
        $this->assertEquals(User::ROLE_ADMIN, $array[2]->role);
    }

    public function testOne()
    {
        $dto = $this->repository
            ->one();
        $this->assertIsObject($dto);
        $this->assertNotEquals($dto->id, 0);
    }

    public function testAll()
    {
        $dtos = $this->repository
            ->all();
        $this->assertIsArray($dtos);
        $this->assertIsObject($dtos[0]);
    }

    public function testAsDataProvider()
    {
        $dataProvider = $this->repository
            ->asDataProvider();
        $this->assertInstanceOf(\yii\data\ActiveDataProvider::class, $dataProvider);
    }

    public function testFindOneById()
    {
        $dto = $this->repository
            ->findOneById(1);
        $this->assertIsObject($dto);
        $this->assertEquals($dto->id, 1);
    }

    public function testFindManyByIds()
    {
        $dtos = $this->repository
            ->findManyByIds([1, 2]);
        $this->assertIsArray($dtos);
        $this->assertEquals($dtos[0]->id, 1);
        $this->assertEquals($dtos[1]->id, 2);
    }

    public function testFindOneByCriteria()
    {
        $dto = $this->repository
            ->findOneByCriteria([UserRepository::PRIMARY_KEY => 1]);
        $this->assertIsObject($dto);
        $this->assertEquals($dto->id, 1);
    }

    public function testFindManyByCriteria()
    {
        $dtos = $this->repository
            ->findManyByCriteria([UserRepository::PRIMARY_KEY => 1]);
        $this->assertIsArray($dtos);
        $this->assertEquals($dtos[0]->id, 1);
    }

    public function testFindAll()
    {
        $dtos = $this->repository
            ->findAll(2);
        $this->assertIsArray($dtos);
        $this->assertIsObject($dtos[0]);
        $this->assertCount(2, $dtos);
    }

    public function testFindByUsername()
    {
        $dto = $this->repository->findByUsername('admin');
        $this->assertIsObject($dto);
        $this->assertEquals($dto->username, 'admin');
    }
}
