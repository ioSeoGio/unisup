<?php 

namespace dispatchers;

use events\EventInterface;

interface EventDispatcherInterface
{
	public function dispatch(EventInterface $event);
}