<?php

namespace domain\educationalWork;

use domain\workReport\DocumentInfoProvider as BaseDocumentInfoProvider;
use domain\workReport\WorkReportLevel;
use domain\teacher\TeacherRepository;
use models\base\WorkReport;
use models\Teacher;

class DocumentInfoProvider extends BaseDocumentInfoProvider
{
	private ?RequestDto $requestDto = null;
	private ?Teacher $teacherDto = null;

	public function __construct(
		private TeacherRepository $teacherRepository,
	) {}

	public function setDto(RequestDto $dto): void
	{
		$this->requestDto = $dto;
	}

	public function getDescription(string $description): string
	{
		return " – $description";
	}

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

	public function getTeacher(): Teacher
	{
		$this->setTeacherIfEmpty();
		return $this->teacherDto;
	}

	public function getWorkReports(): array
	{
		$this->setTeacherIfEmpty();
		return $this->teacherDto->educationalWorkReports;		
	}

	public function getHeaderStrings(): array
	{
		$this->setTeacherIfEmpty();
		$this->guardRequestDtoIsset();

		$headerStrings = [];
		$headerStrings[] = 'ПОКАЗАТЕЛИ';
		$headerStrings[] = 'результатов воспитательной и идеологической работы';
		$headerStrings[] = "{$this->teacherDto->full_name},";
		$headerStrings[] = $this->requestDto->documentHeaderString;

		return $headerStrings;
	}

	private function setTeacherIfEmpty(): void
	{
		if (!$this->teacherDto) {
			$this->teacherDto = $this->teacherRepository
				->findOneById($this->requestDto->teacherId, ['educationalWorkReports.type']);
		}
	}

	private function guardRequestDtoIsset()
	{
		if (!$this->requestDto) {
			throw new \DomainException('You should set $requestDto using setDto() first');
		}
	}
}
