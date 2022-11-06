<?php declare(strict_types=1);

namespace domain\journalRecord;

class CreateAction
{
	public function __construct(
		private Creator $creator,
	) {}

	public function run(object $requestDto): object
	{
        return $this->creator->create($requestDto);
	}
}
