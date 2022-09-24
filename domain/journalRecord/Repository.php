<?php declare(strict_types=1);

namespace domain\journalRecord;

use data\YiiArRepository;
use models\query\JournalRecordQuery as Query;

class Repository extends YiiArRepository
{
	public function __construct(
        Query $query,
	) {
		parent::__construct($query);
	}
}
