<?php

namespace app\bootstrap;

use Yii;
use yii\base\BootstrapInterface;

use dispatchers\SimpleEventDispatcher; 
use services\RbacService;
use services\MessageService;

class Bootstrap implements BootstrapInterface
{
	public function bootstrap($app)
	{
		$container = Yii::$container;

		$container->setSingleton('dispatchers\EventDispatcherInterface', function () {
			return new SimpleEventDispatcher([
				// 'eventClass' => [listeners classes],
			]); 
		});

		$container->setSingleton('services\RbacServiceInterface', function () {
			return new RbacService();
		});
		
		$container->setSingleton('services\MessageServiceInterface', function () {
			return new MessageService();
		});
	}
}
