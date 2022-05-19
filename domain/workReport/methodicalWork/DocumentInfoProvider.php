<?php

namespace domain\workReport\methodicalWork;

use domain\workReport\DocumentInfoProvider as BaseDocumentInfoProvider;
use domain\teacher\TeacherRepository;
use models\Teacher;

class DocumentInfoProvider extends BaseDocumentInfoProvider
{
	private ?RequestDto $requestDto = null;
	private ?Teacher $teacherDto = null;

	private static $workReportCounter = 1;

	public function __construct(
		private TeacherRepository $teacherRepository,
	) {}

	public function setDto(RequestDto $dto): void
	{
		$this->requestDto = $dto;
	}

	public function getDescription(string $description): string
	{
		$i = self::$workReportCounter;
		self::$workReportCounter++;

		return "{$i}. $description";
	}

	public function getTeacher(): Teacher
	{
		$this->setTeacherIfEmpty();
		return $this->teacherDto;
	}

	public function getWorkReports(): array
	{
		$this->setTeacherIfEmpty();
		return $this->teacherDto->methodicalWorkReports;		
	}

	public function getHeaderStrings(): array
	{
		$this->setTeacherIfEmpty();
		$this->guardRequestDtoIsset();

		$headerStrings = [];
		$headerStrings[] = 'ПОКАЗАТЕЛИ';
		$headerStrings[] = 'результатов учебно-методической работы';
		$headerStrings[] = "{$this->teacherDto->full_name},";
		$headerStrings[] = $this->requestDto->documentHeaderString;

		return $headerStrings;
	}

	private function setTeacherIfEmpty(): void
	{
		if (!$this->teacherDto) {
			$this->teacherDto = $this->teacherRepository
				->findOneById($this->requestDto->teacherId, ['methodicalWorkReports.type']);
		}
	}

	private function guardRequestDtoIsset()
	{
		if (!$this->requestDto) {
			throw new \DomainException('You should set $requestDto using setDto() first');
		}
	}
}
