<?php declare(strict_types=1);

namespace domain\journal;

use actions\ActionInterface;

class ReadAction implements ActionInterface
{
	public function __construct(
		private Repository $repository,
	) {}

	public function run(object $requestDto): object
	{
		return $this->repository->getOneById($requestDto->id);
	}
}
