<?php

namespace domain\methodicalWorkAuthor;

use data\YiiArCreator;
use models\query\MethodicalWorkReportAuthorQuery;
use domain\methodicalWorkAuthor\Factory as AuthorFactory;

class Creator extends YiiArCreator
{
	public function __construct(
        MethodicalWorkReportAuthorQuery $query,
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
