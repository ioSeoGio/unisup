<?php declare(strict_types=1);

namespace domain\methodicalWork;

use data\YiiArUpdater;

use domain\methodicalWorkAuthor\Creator as AuthorCreator;
use domain\methodicalWorkAuthor\Deleter as AuthorDeleter;
use domain\methodicalWorkAuthor\Factory as AuthorFactory;

use models\query\MethodicalWorkReportQuery;

class Updater extends YiiArUpdater
{
	public function __construct(
        MethodicalWorkReportQuery $query,
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
