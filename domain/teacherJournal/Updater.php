<?php

namespace domain\teacherJournal;

use data\YiiArUpdater;
use models\query\TeacherJournalQuery as Query;

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
