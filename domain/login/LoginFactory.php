<?php

namespace domain\login;

class LoginFactory extends \factories\BaseRequestFactory
{
	public function makeDto(): LoginCredentialsDto
	{
		$dto = new LoginCredentialsDto();
		$dto->username = $this->bodyParams['username'];
		$dto->password = $this->bodyParams['password'];
		return $dto;
	}
}