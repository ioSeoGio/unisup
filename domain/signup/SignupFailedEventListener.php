<?php

namespace domain\signup;

use events\EventInterface;
use listeners\BaseEventListener;

class SignupFailedEventListener extends BaseEventListener
{
	public function handle(EventInterface $event): void
	{
	}
}