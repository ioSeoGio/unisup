<?php

namespace domain\journalRecord;

use data\YiiArCreator;
use models\query\JournalRecordQuery as Query;

class Creator extends YiiArCreator
{
	public function __construct(
        Query $query,
	) {
		parent::__construct($query);
	}

	public function create(array|object $data): object
	{
		$dto = parent::create($data);
		return $dto;
	}
}
