<?php

namespace domain\workReport;

use domain\workReport\WorkReportLevel;
use models\base\WorkReport;
use models\Teacher;

abstract class DocumentInfoProvider
{
	const SYMBOLS_AMOUNT_PER_TEXT_BREAK = 110;

	public function countTextBreaks(string $description): int
	{
		return strlen($description) / self::SYMBOLS_AMOUNT_PER_TEXT_BREAK;
	}

	public function getAmountOfPoints(WorkReport $dto): array
	{
		$pointsTypeVarName = "{$dto->level}_points"; 
		$points = $dto->type->$pointsTypeVarName;

		$rawPoints = $points / $dto->authorsAmount;
		$roundedPoints = ceil($rawPoints * 10) / 10;
		return [$rawPoints, $roundedPoints];
	}

	abstract public function getDescription(string $description): string;
	abstract public function getTeacher(): Teacher;
	abstract public function getWorkReports(): array;
	abstract public function getHeaderStrings(): array;
}
