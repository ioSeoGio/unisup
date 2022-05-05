<?php 

namespace domain\login;

use transformers\BaseTransformer;
use models\User;

class LoginTransformer extends BaseTransformer
{
	public function __construct(
		private User $dto
	) {}

	public function jsonSerialize(): mixed
	{
		return [
			'username' => $this->dto->username,
			'access_token' => $this->dto->access_token,
		];
	}
}
