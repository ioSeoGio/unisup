<?php

namespace domain\login;

use factories\BaseRequestFactory;

class LoginFactory extends BaseRequestFactory
{
    public function makeDto(): LoginCredentialsDTO
    {
        $dto = new LoginCredentialsDTO();
        $dto->username = $this->bodyParams['username'];
        $dto->password = $this->bodyParams['password'];
        return $dto;
    }
}
