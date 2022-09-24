<?php declare(strict_types=1);

namespace listeners;

use events\EventInterface;

abstract class BaseEventListener
{
	abstract public function handle(EventInterface $event): void;
}