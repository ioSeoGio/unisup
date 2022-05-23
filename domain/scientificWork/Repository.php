<?php

namespace domain\scientificWork;

use data\YiiArRepository;
use models\query\ScientificWorkReportQuery;

class Repository extends YiiArRepository
{
	public function __construct(
        ScientificWorkReportQuery $query,
	) {
		parent::__construct($query);
	}
}
