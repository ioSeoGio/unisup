<?php

namespace domain\user;

use data\YiiArRepository;

class UserRepository extends YiiArRepository
{
	public function findByUsername(string $username): ?object
	{
		return $this->findOneByCriteria(['username' => $username]);
	}
}
