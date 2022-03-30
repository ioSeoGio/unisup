<?php

namespace domain\login;

use events\EventInterface;

class LoginFailedEvent implements EventInterface
{
	public function __construct(
	) {}
}