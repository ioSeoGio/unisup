<?php

namespace tests\unit\repositories;

use Codeception\Stub;
use Codeception\Stub\Expected;
use data\YiiArRepository;
use factories\RepositoryFactoryInterface;
use yii\db\ActiveQuery;

class YiiArRepositoryTest extends \Codeception\Test\Unit
{
    private $queryStub;
    private $factoryStub;
    private $repository;

    private function suiteOne($methodName)
    {
        $this->queryStub = Stub::makeEmpty(ActiveQuery::class, [
            $methodName => Expected::once(),
        ]);
        $this->factoryStub = Stub::makeEmpty(RepositoryFactoryInterface::class);
        $this->repository = $this->construct(
            YiiArRepository::class,
            [$this->queryStub, $this->factoryStub],
        );
    }

    public function testWith()
    {
        $this->suiteOne('with');
        $this->assertInstanceOf(YiiArRepository::class, $this->repository->with());
    }

    public function testSelect()
    {
        $this->suiteOne('select');
        $this->assertInstanceOf(YiiArRepository::class, $this->repository->select());
    }

    public function testLimit()
    {
        $this->suiteOne('limit');
        $this->assertInstanceOf(YiiArRepository::class, $this->repository->limit());
    }

    public function testOrderBy()
    {
        $this->suiteOne('orderBy');
        $this->assertInstanceOf(YiiArRepository::class, $this->repository->orderBy());
    }
}
