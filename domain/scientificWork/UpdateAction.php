<?php

namespace domain\scientificWork;

use actions\ActionInterface;

class UpdateAction implements ActionInterface
{
	public function __construct(
		private Updater $updater,
	) {}

	public function run(object $requestDto): object
	{
		$dto = $this->updater->updateOneById($requestDto->id, $requestDto);
    	return $dto;
	}
}
