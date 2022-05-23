<?php

namespace domain\methodicalWork;

use data\YiiArRepository;
use models\query\MethodicalWorkReportQuery;

class Repository extends YiiArRepository
{
	public function __construct(
        MethodicalWorkReportQuery $query,
	) {
		parent::__construct($query);
	}
}
