<?php

namespace domain\user;

use Yii;

class UserService
{
	public function validatePassword(string $password, object $user): bool
	{
		return Yii::$app->security->validatePassword($password, $user?->password_hash);
	}
}