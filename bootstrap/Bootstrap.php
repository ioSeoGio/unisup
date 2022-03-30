<?php

namespace app\bootstrap;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
	public function bootstrap($app)
	{
		$container = Yii::$container;
	}
}
