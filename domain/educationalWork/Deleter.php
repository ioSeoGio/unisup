<?php declare(strict_types=1);

namespace domain\educationalWork;

use data\YiiArDeleter;
use models\query\EducationalWorkReportQuery;
use domain\educationalWorkAuthor\Deleter as AuthorDeleter;

class Deleter extends YiiArDeleter
{
	public function __construct(
        EducationalWorkReportQuery $query,
		private AuthorDeleter $authorDeleter,
	) {
		parent::__construct($query);
	}

	public function deleteOneById(int $reportId): bool
	{
		$result = $this->authorDeleter->deleteRecordsByReportId($reportId);
		if ($result) {
			return parent::deleteOneById($reportId);
		}
		return false;
	}
}
