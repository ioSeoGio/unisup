<?php

namespace tests\unit\forms;

use domain\login\LoginForm;
use Yii;

class LoginFormTest extends \Codeception\Test\Unit
{
    private $form;

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
        $this->form = Yii::$container->get(LoginForm::class);
    }

    public function testSuccessValidateForm()
    {
        $data = [
            'username' => 'admin',
            'password' => '12345678',
        ];

        $this->assertTrue($this->form->load($data));
        $this->assertTrue($this->form->validate());
    }

    public function testNotExistingUserLogin()
    {
        $data = [
            'username' => 'not-existing-user',
            'password' => 'random-password',
        ];

        $this->assertTrue($this->form->load($data));
        $this->assertFalse($this->form->validate());
    }

    public function testNotCorrectPasswordLogin()
    {
        $data = [
            'username' => 'admin',
            'password' => 'not-correct-password',
        ];

        $this->assertTrue($this->form->load($data));
        $this->assertFalse($this->form->validate());
    }
}
