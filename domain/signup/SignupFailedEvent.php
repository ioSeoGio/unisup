<?php

namespace domain\signup;

use events\EventInterface;

class SignupFailedEvent implements EventInterface
{
	public function __construct(
	) {}
}