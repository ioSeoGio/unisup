<?php

namespace domain\journalRecord;

use actions\ActionInterface;

class UpdateAction implements ActionInterface
{
	public function __construct(
		private Updater $updater,
	) {}

	public function run(object $requestDto): object
	{
		return $this->updater->updateOneById($requestDto->id, $requestDto);
	}
}
