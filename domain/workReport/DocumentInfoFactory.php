<?php 

namespace domain\workReport;

use domain\educationalWork\DocumentInfoProvider;
use domain\workReport\WorkReportDto;

class DocumentInfoFactory
{
	private DocumentInfoDto $dto;
	private DocumentInfoProvider $infoProvider;

	public function setInfoProvider(DocumentInfoProvider $infoProvider)
	{
		$this->infoProvider = $infoProvider;
	}

	public function makeDto(): DocumentInfoDto
	{
		$this->guardInfoProviderIsset();

		$teacherDto = $this->infoProvider->getTeacher();
		$workReports = $this->infoProvider->getWorkReports();

		$this->dto = new DocumentInfoDto();
		$this->fillHeaderStrings();
		$this->fillWorkReports($workReports);

		return $this->dto;
	}

	private function guardInfoProviderIsset()
	{
		if (!$this->infoProvider) {
			throw new \DomainException('You should set $infoProvider before calling makeDto()');
		}
	}

	private function fillHeaderStrings(): void
	{
		$this->dto->headerStrings = $this->infoProvider->getHeaderStrings();
	}

	private function fillWorkReports(array $workReports): void
	{
		$workReportsGrouppedByTypeId = [];
		foreach ($workReports as $workReport) {
			$description = $workReport->description;

			$workReportDto = new WorkReportDto();
			
			$workReportDto->description = $this->infoProvider->getDescription($description);
			$workReportDto->textBreaksAmount = $this->infoProvider->countTextBreaks($description);
			$workReportDto->points = $this->infoProvider->getAmountOfPoints($workReport);
			$workReportDto->level = $workReport->level;
			
			$this->dto->totalPoints += $workReportDto->points;
			$workReportsGrouppedByTypeId[$workReport->type_id][] = $workReportDto;
		}
		$this->dto->workReportsGrouppedByTypeId = $workReportsGrouppedByTypeId;
	}
}
