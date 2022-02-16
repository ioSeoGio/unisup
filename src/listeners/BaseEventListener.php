<?php

namespace src\listeners;

use src\events\BaseEvent;

abstract class BaseEventListener
{
	abstract public function handle(BaseEvent $event): void;
}