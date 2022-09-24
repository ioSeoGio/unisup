<?php declare(strict_types=1);

namespace domain\methodicalWorkAuthor;

use data\YiiArDeleter;
use models\query\MethodicalWorkReportAuthorQuery;

class Deleter extends YiiArDeleter
{
	public function __construct(
        MethodicalWorkReportAuthorQuery $query,
	) {
		parent::__construct($query);
	}

	public function deleteRecordsByReportId(int $reportId): bool
	{
		return parent::deleteManyByCriteria(['work_report_id' => $reportId]);
	}
}
