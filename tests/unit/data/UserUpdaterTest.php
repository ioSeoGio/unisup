<?php

namespace tests\unit\data;

use domain\user\Updater as UserUpdater;
use models\User;

class UserUpdaterTest extends \Codeception\Test\Unit
{
    private $updater;

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
        $this->updater = \Yii::$container->get(UserUpdater::class);
    }

    public function testUpdateOneById()
    {
        $dto = $this->updater
            ->updateOneById(1, ['username' => 'admin_updated']);
        $this->assertIsObject($dto);
        $this->assertEquals($dto->username, 'admin_updated');
    }

    public function testUpdateManyByIds()
    {
        $dtos = $this->updater
            ->updateManyByIds([1, 2], ['username' => 'updated_username']);
        $this->assertIsArray($dtos);
        $this->assertIsObject($dtos[0]);
        $this->assertEquals($dtos[0]->username, 'updated_username');
        $this->assertEquals($dtos[1]->username, 'updated_username');
    }

    public function testUpdateOneByCriteria()
    {
        $dto = $this->updater
            ->updateOneByCriteria([UserUpdater::PRIMARY_KEY => 1], ['username' => 'admin_updated']);
        $this->assertIsObject($dto);
        $this->assertEquals($dto->username, 'admin_updated');
    }

    public function testUpdateManyByCriteria()
    {
        $dtos = $this->updater
            ->updateManyByCriteria(['status' => User::STATUS_ACTIVE], ['status' => User::STATUS_INACTIVE]);
        $this->assertIsArray($dtos);
        $this->assertIsObject($dtos[0]);
        $this->assertEquals($dtos[0]->status, User::STATUS_INACTIVE);
        $this->assertEquals($dtos[1]->status, User::STATUS_INACTIVE);
        $this->assertEquals($dtos[2]->status, User::STATUS_INACTIVE);
    }
}
