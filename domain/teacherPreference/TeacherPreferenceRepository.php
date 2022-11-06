<?php declare(strict_types=1);

namespace domain\teacherPreference;

use data\YiiArRepository;
use models\query\TeacherPreferenceQuery;

class TeacherPreferenceRepository extends YiiArRepository
{
	public function __construct(
        TeacherPreferenceQuery $query,
	) {
		parent::__construct($query);
	}

    public function getAll(): array
    {
        return $this->query
            ->select("")
            ->all();
    }
}
