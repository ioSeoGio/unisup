<?php

namespace tests\unit\factories;

use Codeception\Stub;
use seog\db\ActiveRecordAdapter;
use factories\DataFactory;
use domain\user\UserDTO;
use models\User;

class DataFactoryTest extends \Codeception\Test\Unit
{
	public const DATA = [
        'id' => 1,
        'username' => 'test-username',
        'email' => 'test-email',
        'role' => User::ROLE_ADMIN,
        'status' => User::STATUS_ACTIVE,
        'created_at' => 'test-created_at',
        'updated_at' => 'test-updated_at',
	];


	public function testDataOverflow()
	{
		$factory = new DataFactory(UserDTO::class);

		$overflowData = array_merge(self::DATA, [
			'overflowAttribute' => 'overflowValue',
		]);
		$dto = $factory->makeDto($overflowData);
		$this->verifyDTO($dto); 
	}

    public function testmakeDtoFromArray()
    {
        $factory = new DataFactory(UserDTO::class);
        $dto = $factory->makeDto(self::DATA);

        $this->verifyDTO($dto);
    }

    public function testmakeDtoFromObject()
    {
        $factory = new DataFactory(UserDTO::class);
        $dataObject = Stub::makeEmpty(
            ActiveRecordAdapter::class,
            [
                'asArray' => array_merge(self::DATA, ['password' => 'test-password']),
            ]
        );

        $dto = $factory->makeDto($dataObject);
        $this->verifyDTO($dto);
    }

    private function verifyDTO($dto)
    {
        $this->assertIsObject($dto);

        foreach (self::DATA as $attributeName => $attributeValue) {
            $this->assertEquals($attributeValue, $dto->$attributeName);
        }
    }
}
