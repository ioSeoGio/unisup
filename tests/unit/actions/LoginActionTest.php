<?php

namespace tests\unit\actions;

use domain\login\LoginCredentialsDTO;
use tests\dummy\DummyEventDispatcher;

class LoginActionTest extends \Codeception\Test\Unit
{
    private $action;

    public function _before()
    {
        $container = \Yii::$container;

        $container->set('dispatchers\EventDispatcherInterface', new DummyEventDispatcher());
    	$this->action = $container->get('domain\login\LoginAction');
    }

    public function testSuccessAction()
    {
        $dto = new LoginCredentialsDTO();
        $dto->username = 'admin';
        $dto->password = '12345678';

    	$this->assertTrue($this->action->run($dto));
    }
}
