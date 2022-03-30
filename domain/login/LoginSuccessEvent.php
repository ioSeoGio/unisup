<?php

namespace domain\login;

use events\EventInterface;

class LoginSuccessEvent implements EventInterface
{
	public function __construct(
	) {}
}