<?php

namespace events\signup;

class SignupSuccessEvent extends \events\BaseEvent
{
	public function __construct(
		\forms\SignupForm $form
	) {}
}