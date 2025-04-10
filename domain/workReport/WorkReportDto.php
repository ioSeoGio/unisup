<?php declare(strict_types=1);

namespace domain\workReport;

class WorkReportDto
{
	public string $description = '';
	public int $textBreaksAmount = 1;
	public int $points = 0;
	public string $level;
}
