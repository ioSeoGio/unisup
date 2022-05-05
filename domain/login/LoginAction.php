<?php

namespace domain\login;

use actions\ActionInterface;
use dispatchers\EventDispatcherInterface;
use domain\user\UserRepository;

class LoginAction implements ActionInterface
{
	public function __construct(
		private EventDispatcherInterface $dispatcher,
		private LoginSuccessEvent $successEvent,
		private UserRepository $repository,
	) {}

	public function run(object $dto): mixed
	{
		$dto = $this->repository->findByUsername($dto->username);
		$this->successEvent->setDto($dto);
		$this->dispatcher->dispatch($this->successEvent);
    	return $dto;
	}
}
