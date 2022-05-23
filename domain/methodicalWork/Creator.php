<?php

namespace domain\methodicalWork;

use data\YiiArCreator;

use domain\methodicalWorkAuthor\Creator as AuthorCreator;

use models\query\MethodicalWorkReportQuery;

class Creator extends YiiArCreator
{
	public function __construct(
        MethodicalWorkReportQuery $query,
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
