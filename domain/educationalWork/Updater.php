<?php declare(strict_types=1);

namespace domain\educationalWork;

use data\YiiArUpdater;

use domain\educationalWorkAuthor\Creator as AuthorCreator;
use domain\educationalWorkAuthor\Deleter as AuthorDeleter;
use domain\educationalWorkAuthor\Factory as AuthorFactory;

use models\query\EducationalWorkReportQuery;

class Updater extends YiiArUpdater
{
	public function __construct(
        EducationalWorkReportQuery $query,
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
