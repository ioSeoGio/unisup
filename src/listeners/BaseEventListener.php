<?php

namespace listeners;

use events\BaseEvent;

abstract class BaseEventListener
{
	abstract public function handle(BaseEvent $event): void;
}