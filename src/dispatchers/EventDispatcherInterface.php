<?php 

namespace dispatchers;

use events\BaseEvent;

interface EventDispatcherInterface
{
	public function dispatch(BaseEvent $event);
}