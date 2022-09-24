<?php declare(strict_types=1);

namespace domain\user;

use Yii;

class Service
{
	public function validatePassword(string $password, object $user): bool
	{
		return Yii::$app->security->validatePassword($password, $user?->password_hash);
	}
}