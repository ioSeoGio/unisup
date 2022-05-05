<?php

namespace events;

interface EventInterface
{
	public function setDto(object $dto): void;
}