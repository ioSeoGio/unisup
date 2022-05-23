<?php

namespace domain\educationalWork;

use actions\ActionInterface;

class DeleteAction implements ActionInterface
{
	public function __construct(
		private Deleter $deleter,
	) {}

	public function run(object $requestDto): bool
	{
		return $this->deleter->deleteOneById($requestDto->id);
	}
}
