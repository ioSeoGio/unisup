<?php

namespace events\signup;

class SignupFailedEvent extends BaseEvent
{
	public function __construct(
		\form\SignupForm $form
	) {}
}