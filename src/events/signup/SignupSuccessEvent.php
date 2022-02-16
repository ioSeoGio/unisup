<?php

namespace src\events\signup;

class SignupSuccessEvent extends BaseEvent
{
	public function __construct(
		signupDTO $signupDTO
	) {}
}