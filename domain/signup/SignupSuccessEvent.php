<?php

namespace domain\signup;

use events\EventInterface;

class SignupSuccessEvent implements EventInterface
{
	public function __construct(
	) {}
}