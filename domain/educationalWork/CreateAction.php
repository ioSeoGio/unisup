<?php declare(strict_types=1);

namespace domain\educationalWork;

use actions\ActionInterface;

class CreateAction implements ActionInterface
{
	public function __construct(
		private Creator $creator,
	) {}

	public function run(object $requestDto): object
	{
		$dto = $this->creator->create($requestDto);
    	return $dto;
	}
}
