<?php declare(strict_types=1);

namespace domain\journal;

use data\YiiArDeleter;
use models\query\JournalQuery as Query;
use domain\journalRecord\Deleter as JournalRecordDeleter;

class Deleter extends YiiArDeleter
{
	public function __construct(
        Query $query,
        private JournalRecordDeleter $journalRecordDeleter,
	) {
		parent::__construct($query);
	}

	public function deleteOneById(int $journalId): bool
	{
		$result = $this->journalRecordDeleter->deleteRecordsByJournalId($journalId);
		if ($result) {
			return parent::deleteOneById($journalId);
		}
		return false;
	}
}
