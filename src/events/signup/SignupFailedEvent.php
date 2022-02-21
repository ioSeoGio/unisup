<?php

namespace events\signup;

class SignupFailedEvent extends \events\BaseEvent
{
	public function __construct(
		\forms\SignupForm $form
	) {}
}