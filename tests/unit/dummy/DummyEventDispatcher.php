<?php

namespace tests\dummy;

use events\EventInterface;
use dispatchers\EventDispatcherInterface;

class DummyEventDispatcher implements EventDispatcherInterface
{
	public function dispatch(EventInterface $event) {}
}
