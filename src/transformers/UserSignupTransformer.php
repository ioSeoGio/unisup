<?php 

namespace transformers;

use actions\SignupAction;

class UserSignupTransformer extends BaseTransformer
{
	public function transform(): array
	{
		$user = $this->action->form->user;

		return [
			'username' => $user->username,
			'access_token' => $user->access_token,
		];
	}
}
