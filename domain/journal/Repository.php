<?php declare(strict_types=1);

namespace domain\journal;

use data\YiiArRepository;
use models\query\JournalQuery as Query;

class Repository extends YiiArRepository
{
	public function __construct(
        Query $query,
	) {
		parent::__construct($query);
	}
}
