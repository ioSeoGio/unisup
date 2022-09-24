<?php declare(strict_types=1);

namespace events;

interface EventInterface
{
	public function setDto(object $dto): void;
}