<?php 

namespace src\dispatchers;

use src\events\BaseEvent;

interface EventDispatcherInterface
{
	public function dispatch(BaseEvent $event);
}