<?php

namespace tests\unit\repositories;

class UserRepositoryTest extends \Codeception\Test\Unit
{
    public function _fixtures()
    {
        return [
            'users' => [
                'class' => \tests\fixtures\UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'users.php',
            ],
        ];
    }

}
