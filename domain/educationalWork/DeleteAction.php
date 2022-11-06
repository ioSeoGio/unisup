<?php declare(strict_types=1);

namespace domain\educationalWork;

class DeleteAction
{
	public function __construct(
		private Deleter $deleter,
	) {}

	public function run(int $id): bool
	{
		return $this->deleter->deleteOneById($id);
	}
}
