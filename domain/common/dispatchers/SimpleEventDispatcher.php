<?php declare(strict_types=1);

namespace dispatchers;

use events\EventInterface;

class SimpleEventDispatcher implements EventDispatcherInterface
{
	private array $listeners = [];

	public function __construct(array $listeners) 
	{
		$this->listeners = $listeners;
	}

	public function dispatch(EventInterface $event)
	{
		$eventName = $event::class;

		if (isset($this->listeners[$eventName])) {
			$eventListenters = $this->listeners[$eventName];

			foreach ($eventListenters as $listenerClass) {
				$listener = \Yii::createObject($listenerClass);
				call_user_func([$listener, 'handle'], $event);
			}
		}
	}
}