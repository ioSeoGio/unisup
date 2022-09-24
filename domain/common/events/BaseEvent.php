<?php declare(strict_types=1);

namespace events;

abstract class BaseEvent implements EventInterface
{
	protected object $dto;

	public function setDto(object $dto): void
	{
		$this->dto = $dto;
	}
}