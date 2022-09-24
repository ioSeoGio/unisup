<?php declare(strict_types=1);

namespace domain\login;

use actions\ActionInterface;
use dispatchers\EventDispatcherInterface;
use domain\user\Repository as UserRepository;
use models\User;

class LoginAction implements ActionInterface
{
	public function __construct(
		private EventDispatcherInterface $dispatcher,
		private LoginSuccessEvent $successEvent,
		private UserRepository $repository,
	) {}

	public function run(object $dto): User
	{
		$dto = $this->repository->findByUsername($dto->username, ['teacher']);
		$this->successEvent->setDto($dto);
		$this->dispatcher->dispatch($this->successEvent);
    	return $dto;
	}
}
