<?php declare(strict_types=1);

namespace domain\journalRecord;

use data\YiiArDeleter;
use models\query\JournalRecordQuery as Query;

class Deleter extends YiiArDeleter
{
	public function __construct(
        Query $query,
	) {
		parent::__construct($query);
	}

	public function deleteRecordsByJournalId(int $journalId): bool
	{
		return parent::deleteManyByCriteria(['journal_id' => $journalId]);
	}
}
