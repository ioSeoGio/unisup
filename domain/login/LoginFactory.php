<?php

namespace domain\login;

use factories\BaseFactory;

class LoginFactory extends BaseFactory
{
	public function makeDTO(): LoginCredentialsDTO
	{
		$dto = new LoginCredentialsDTO();
		$dto->username = $this->bodyParams['username'];
		$dto->password = $this->bodyParams['password'];
		return $dto;
	}
}
