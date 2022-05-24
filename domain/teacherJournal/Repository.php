<?php

namespace domain\teacherJournal;

use data\YiiArRepository;
use models\query\TeacherJournalQuery as Query;

class Repository extends YiiArRepository
{
	public function __construct(
        Query $query,
	) {
		parent::__construct($query);
	}
}
