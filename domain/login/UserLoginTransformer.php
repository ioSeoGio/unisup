<?php 

namespace domain\login;

use transformers\BaseTransformer;

class UserLoginTransformer extends BaseTransformer
{
	public function transform(): array
	{
		return [
			'username' => $user->username,
			'access_token' => $user->access_token,
		];
	}
}
