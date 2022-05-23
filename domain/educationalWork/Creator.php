<?php

namespace domain\educationalWork;

use data\YiiArCreator;

use domain\educationalWorkAuthor\Creator as AuthorCreator;

use models\query\EducationalWorkReportQuery;

class Creator extends YiiArCreator
{
	public function __construct(
        EducationalWorkReportQuery $query,
		private AuthorCreator $authorCreator,
	) {
		parent::__construct($query);
	}

	public function create(array|object $data): object
	{
		$teachers = $data->teachers;
		unset($data->teachers);
		$data = $this->makeArray($data);

		$dto = parent::create($data);
		$this->authorCreator->createManyByTeachers($dto->id, $teachers);

		return $dto;
	}
}
