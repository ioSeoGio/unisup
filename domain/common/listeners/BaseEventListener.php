<?php

namespace listeners;

use events\EventInterface;

abstract class BaseEventListener
{
	abstract public function handle(EventInterface $event): void;
}