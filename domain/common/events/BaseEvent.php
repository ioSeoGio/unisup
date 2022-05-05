<?php

namespace events;

abstract class BaseEvent implements EventInterface
{
	protected object $dto;

	public function setDto(object $dto): void
	{
		$this->dto = $dto;
	}
}