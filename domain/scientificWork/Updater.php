<?php

namespace domain\scientificWork;

use data\YiiArUpdater;

use domain\scientificWorkAuthor\Creator as AuthorCreator;
use domain\scientificWorkAuthor\Deleter as AuthorDeleter;
use domain\scientificWorkAuthor\Factory as AuthorFactory;

use models\query\ScientificWorkReportQuery;

class Updater extends YiiArUpdater
{
	public function __construct(
        ScientificWorkReportQuery $query,
		private AuthorCreator $authorCreator,
		private AuthorDeleter $authorDeleter,
		private AuthorFactory $authorFactory,
	) {
		parent::__construct($query);
	}

	public function updateOneById(int $id, array|object $data): object
	{
		$teachers = $data->teachers;
		unset($data->teachers);
		$data = $this->makeArray($data);

		$dto = parent::updateOneById($id, $data);

		$this->authorDeleter
			->deleteManyByCriteria(['work_report_id' => $dto->id]);
		$this->authorCreator->createManyByTeachers($dto->id, $teachers);

		return $dto;
	}
}
