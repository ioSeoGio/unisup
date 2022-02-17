<?php 

namespace transformers;

use models\User;

class UserSignupTransformer extends BaseTransformer
{
	public static function transform(User $model)
	{
		return [
			'username' => $model->user,
			'access_token' => $model->access_token,
		];
	}
}
