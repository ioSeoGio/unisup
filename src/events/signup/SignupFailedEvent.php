<?php

namespace src\events\signup;

class SignupFailedEvent extends BaseEvent
{
	public function __construct(
		signupDTO $signupDTO
	) {}
}