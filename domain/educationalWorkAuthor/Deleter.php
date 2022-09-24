<?php declare(strict_types=1);

namespace domain\educationalWorkAuthor;

use data\YiiArDeleter;
use models\query\EducationalWorkReportAuthorQuery;

class Deleter extends YiiArDeleter
{
	public function __construct(
        EducationalWorkReportAuthorQuery $query,
	) {
		parent::__construct($query);
	}

	public function deleteRecordsByReportId(int $reportId): bool
	{
		return parent::deleteManyByCriteria(['work_report_id' => $reportId]);
	}
}
