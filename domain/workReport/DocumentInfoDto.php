<?php declare(strict_types=1);


namespace domain\workReport;

class DocumentInfoDto
{
	public array $headerStrings = [];
	public array $workReportsGrouppedByTypeId = [];
	public int $totalPoints = 0;
}
