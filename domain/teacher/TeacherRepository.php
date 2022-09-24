<?php declare(strict_types=1);

namespace domain\teacher;

use data\YiiArRepository;
use models\query\TeacherQuery as Query;

class TeacherRepository extends YiiArRepository
{
	public function __construct(
        Query $query,
	) {
		parent::__construct($query);
	}

}
