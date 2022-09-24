<?php declare(strict_types=1);

namespace models\base;

use seog\db\ActiveRecordAdapter;

abstract class WorkReport extends ActiveRecordAdapter
{
	public function getAuthorsAmount()
	{
		return $this->getTeachers()->count();
	}
}
