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

	public function run(object $dto): mixed
	{
    	$this->dispatcher->dispatch($this->successEvent);
        return ['access_token' => 'K1t9ek5Y5llzWcqee7G5lL2j9SR1Vj6r_1644828238'];

        $this->dispatcher->dispatch($this->failedEvent);
    	return false;
	}
}
