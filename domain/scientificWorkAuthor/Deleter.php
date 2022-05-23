<?php

namespace domain\scientificWorkAuthor;

use data\YiiArDeleter;
use models\query\ScientificWorkReportAuthorQuery;

class Deleter extends YiiArDeleter
{
	public function __construct(
        ScientificWorkReportAuthorQuery $query,
	) {
		parent::__construct($query);
	}

	public function deleteRecordsByReportId(int $reportId): bool
	{
		return parent::deleteManyByCriteria(['work_report_id' => $reportId]);
	}
}
