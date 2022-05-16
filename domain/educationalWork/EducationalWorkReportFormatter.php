<?php

namespace domain\educationalWork;

use domain\workReports\WorkReportFormatter;
use domain\workReports\WorkReportLevel;
use models\base\WorkReport;

class EducationalWorkReportFormatter extends WorkReportFormatter
{
	public function getAmountOfPoints(WorkReport $dto): int
	{
		switch ($dto->level) {
			case WorkReportLevel::FOREIGN:
				return $dto->type->foreign_points;
			case WorkReportLevel::BELARUS:
				return $dto->type->belarus_points;
			case WorkReportLevel::BREST:
				return $dto->type->brest_points;
		}
	}
}
