<?php declare(strict_types=1);

namespace domain\login;

use transformers\BaseTransformer;
use models\User;

class LoginTransformer extends BaseTransformer
{
	public function __construct(
		private User $dto
	) {}

	public function formatResponse(): mixed
	{
		return [
		    'id' => $this->dto->id,
		    'username' => $this->dto->username,
		    'access_token' => $this->dto->access_token,
		    'email' => $this->dto->email,
		    'teacher' => $this->dto->teacher,
		];
	}
}
