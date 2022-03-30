<?php

namespace tests\unit\forms;

use forms\LoginForm;

class LoginFormTest extends \Codeception\Test\Unit
{
    public function _fixtures()
    {
        return [
            'users' => [
                'class' => \tests\fixtures\UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'users.php'
            ],
        ];
    }

	public function testSuccessValidateForm()
	{
    	$form = new LoginForm();
    	$data = [
    		'username' => 'admin',
    		'password' => '12345678',
    	];

    	$this->assertTrue($form->load($data));
    	$this->assertTrue($form->validate());
	}

	public function testNotExistingUserLogin()
	{
    	$form = new LoginForm();
    	$data = [
    		'username' => 'not-existing-user',
    		'password' => 'random-password',
    	];

    	$this->assertTrue($form->load($data));
    	$this->assertFalse($form->validate());
	}

	public function testNotCorrectPasswordLogin()
	{
    	$form = new LoginForm();
    	$data = [
    		'username' => 'admin',
    		'password' => 'not-correct-password',
    	];

    	$this->assertTrue($form->load($data));
    	$this->assertFalse($form->validate());
	}
}