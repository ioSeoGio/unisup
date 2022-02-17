<?php

namespace events\signup;

class SignupSuccessEvent extends BaseEvent
{
	public function __construct(
		\form\SignupForm $form
	) {}
}