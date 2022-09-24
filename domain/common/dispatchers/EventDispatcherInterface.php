<?php declare(strict_types=1);


namespace dispatchers;

use events\EventInterface;

interface EventDispatcherInterface
{
	public function dispatch(EventInterface $event);
}