<?php declare(strict_types=1);

namespace domain\scientificWorkAuthor;

use data\YiiArCreator;
use models\query\ScientificWorkReportAuthorQuery;
use domain\scientificWorkAuthor\Factory as AuthorFactory;

class Creator extends YiiArCreator
{
	public function __construct(
        ScientificWorkReportAuthorQuery $query,
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
