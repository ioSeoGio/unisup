<?php declare(strict_types=1);

namespace domain\scientificWork;

use data\YiiArCreator;

use domain\scientificWorkAuthor\Creator as AuthorCreator;

use models\query\ScientificWorkReportQuery;

class Creator extends YiiArCreator
{
	public function __construct(
        ScientificWorkReportQuery $query,
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
