<?php

namespace domain\teacherJournal;

use data\YiiArCreator;
use models\query\TeacherJournalQuery as Query;

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
