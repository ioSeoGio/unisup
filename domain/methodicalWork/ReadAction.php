<?php declare(strict_types=1);

namespace domain\methodicalWork;

class ReadAction
{
	public function __construct(
		private Repository $repository,
	) {}

	public function run(int $id): object
	{
		return $this->repository->getOneById($id);
	}
}
