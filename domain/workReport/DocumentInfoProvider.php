<?php

namespace domain\workReport;

use models\base\WorkReport;
use models\Teacher;

abstract class DocumentInfoProvider
{
	const SYMBOLS_AMOUNT_PER_TEXT_BREAK = 110;

	public function countTextBreaks(string $description): int
	{
		return strlen($description) / self::SYMBOLS_AMOUNT_PER_TEXT_BREAK;
	}

	abstract public function getDescription(string $description): string;
	abstract public function getAmountOfPoints(WorkReport $dto): int;
	abstract public function getTeacher(): Teacher;
	abstract public function getWorkReports(): array;
	abstract public function getHeaderStrings(): array;
}
