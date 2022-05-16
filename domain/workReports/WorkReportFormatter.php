<?php

namespace domain\workReports;

use models\base\WorkReport;

abstract class WorkReportFormatter
{
	const SYMBOLS_AMOUNT_PER_TEXT_BREAK = 110;

	public function countTextBreaks(string $description): int
	{
		return strlen($description) / self::SYMBOLS_AMOUNT_PER_TEXT_BREAK;
	}

	public function getFormattedDescription(string $description): string
	{
		return " – $description";
	}

	abstract public function getAmountOfPoints(WorkReport $dto): int;
}
