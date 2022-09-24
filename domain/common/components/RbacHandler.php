<?php declare(strict_types=1);

namespace components;

use Yii;

class RbacHandler implements RbacHandlerInterface
{
	private array $rules = [];
	private array $permissions = [];
	private array $roles = [];

	public function __construct()
	{
		$authManager = Yii::$app->authManager;
		$authUser = Yii::$app->user;

		if (!$authUser->isGuest) {
			$userId = $authUser->id;
			$this->permissions = array_keys($authManager->getPermissionsByUser($userId));
			$this->roles = array_keys($authManager->getRolesByUser($userId));
		}
	}

	public function addRule(string $name): void
	{
		$this->rules[] = $name;
	}

	public function dump(): array
	{
		return [
		    'roles' => $this->roles,
		    'permissions' => $this->permissions,
		    'rules' => $this->rules,
		];
	}
}