<?php

namespace src\actions;

use src\dispatchers\EventDispatcherInterface;
use src\events\SignupSuccessEvent;
use src\events\SignupFailedEvent;
use src\forms\SignupForm;

class SignupAction
{
	public function __construct(
		EventDispatcherInterface $dispatcher
	) {}

	public function run(array $post)
	{
        $form = new SignupForm();
        if ($form->load($post) && $form->signup()) {

        } else {

        }
	}
}