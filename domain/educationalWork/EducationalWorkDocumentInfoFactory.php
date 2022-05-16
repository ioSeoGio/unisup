<?php 

namespace domain\educationalWork;

use domain\teacher\TeacherRepository;
use domain\workReports\WorkReportDto;
use domain\educationalWork\EducationalWorkReportFormatter;
use models\Teacher;

class EducationalWorkDocumentInfoFactory
{
	private EducationalWorkRequestDto $requestDto;
	private EducationalWorkDocumentInfoDto $dto;

	public function __construct(
		private TeacherRepository $teacherRepository,
		private EducationalWorkReportFormatter $formatter,
	) {}

	public function makeDto(EducationalWorkRequestDto $requestDto): EducationalWorkDocumentInfoDto
	{
		$this->requestDto = $requestDto;

		$teacherDto = $this->teacherRepository
			->findOneById($this->requestDto->teacherId, with: ['educationalWorkReports.type']);

		$this->dto = new EducationalWorkDocumentInfoDto();
		$this->fillHeaderStrings($teacherDto->full_name);
		$this->fillWorkReports($teacherDto->educationalWorkReports);

		return $this->dto;
	}

	private function fillHeaderStrings(string $teacherName): void
	{
		$this->dto->headerStrings[] = 'ПОКАЗАТЕЛИ';
		$this->dto->headerStrings[] = 'результатов воспитательной и идеологической работы';
		$this->dto->headerStrings[] = "{$teacherName},";
		$this->dto->headerStrings[] = $this->requestDto->documentHeaderString;
	}

	private function fillWorkReports(array $educationalWorkReports): void
	{
		$workReportsGrouppedByTypeId = [];
		foreach ($educationalWorkReports as $workReport) {
			$description = $workReport->description;

			$workReportDto = new WorkReportDto();
			
			$workReportDto->description = $this->formatter->getFormattedDescription($description);
			$workReportDto->textBreaksAmount = $this->formatter->countTextBreaks($description);
			$workReportDto->points = $this->formatter->getAmountOfPoints($workReport);
			$workReportDto->level = $workReport->level;
			
			$this->dto->totalPoints += $workReportDto->points;

			$workReportsGrouppedByTypeId[$workReport->type_id][] = $workReportDto;
		}
		$this->dto->workReportsGrouppedByTypeId = $workReportsGrouppedByTypeId;
	}
}
