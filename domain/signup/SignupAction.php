<?php

namespace domain\signup;

use actions\ActionInterface;
use dispatchers\EventDispatcherInterface;

use domain\signup\SignupSuccessEvent;
use domain\signup\SignupFailedEvent;

class SignupAction implements ActionInterface
{
	public function __construct(
		public EventDispatcherInterface $dispatcher
	) {
		$this->successEvent = new SignupSuccessEvent();
		$this->failedEvent = new SignupSuccessEvent();
	}

	public function run(object $dto): bool
	{
    	$this->dispatcher->dispatch($this->successEvent);
    	return true;

        $this->setErrors($this->form);
        $this->dispatcher->dispatch($this->failedEvent);
    	return false;
	}
}
