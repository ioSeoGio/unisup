<?php

namespace domain\educationalWorkAuthor;

use data\YiiArCreator;
use models\query\EducationalWorkReportAuthorQuery;
use domain\educationalWorkAuthor\Factory as AuthorFactory;

class Creator extends YiiArCreator
{
	public function __construct(
        EducationalWorkReportAuthorQuery $query,
		private AuthorFactory $authorFactory,
	) {
		parent::__construct($query);
	}

	public function createManyByTeachers(int $workReportId, array $teachers)
	{
		foreach ($teachers as $teacherId) {
			$authorDto = $this->authorFactory->makeDto(
				$teacherId, 
				$workReportId
			);
			$this->create($authorDto);
		}
	}
}
