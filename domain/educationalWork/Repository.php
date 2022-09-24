<?php declare(strict_types=1);

namespace domain\educationalWork;

use data\YiiArRepository;
use models\query\EducationalWorkReportQuery;

class Repository extends YiiArRepository
{
	public function __construct(
        EducationalWorkReportQuery $query,
	) {
		parent::__construct($query);
	}
}
