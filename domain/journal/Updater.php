<?php declare(strict_types=1);

namespace domain\journal;

use data\YiiArUpdater;
use models\query\JournalQuery as Query;

class Updater extends YiiArUpdater
{
	public function __construct(
        Query $query,
	) {
		parent::__construct($query);
	}

	public function updateOneById(int $id, array|object $data): object
	{
		$dto = parent::updateOneById($id, $data);
		return $dto;
	}
}
