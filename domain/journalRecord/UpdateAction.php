<?php declare(strict_types=1);

namespace domain\journalRecord;

class UpdateAction
{
	public function __construct(
		private Updater $updater,
	) {}

	public function run(int $id, object $requestDto): object
	{
		return $this->updater->updateOneById($id, $requestDto);
	}
}
