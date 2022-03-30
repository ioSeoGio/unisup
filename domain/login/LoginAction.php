<?php

namespace domain\login;

use actions\ActionInterface;
use dispatchers\EventDispatcherInterface;

class LoginAction implements ActionInterface
{
	public function __construct(
		private EventDispatcherInterface $dispatcher,
		private LoginSuccessEvent $successEvent,
		private LoginFailedEvent $failedEvent,
	) {}

	public function run(object $dto): bool
	{
    	$this->dispatcher->dispatch($this->successEvent);
    	return true;

        $this->dispatcher->dispatch($this->failedEvent);
    	return false;
	}
}
