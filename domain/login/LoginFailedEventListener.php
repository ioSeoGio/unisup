<?php declare(strict_types=1);

namespace domain\login;

use events\EventInterface;
use listeners\BaseEventListener;

class LoginFailedEventListener extends BaseEventListener
{
	public function handle(EventInterface $event): void
	{
	}
}