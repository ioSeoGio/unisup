<?php declare(strict_types=1);

namespace domain\journal;

class CreateAction
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
