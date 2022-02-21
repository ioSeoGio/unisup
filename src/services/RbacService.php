<?php

namespace services;

use Yii;
use seog\web\IdentityInterface;

class RbacService implements RbacServiceInterface
{
	private array $rules = [];
	private array $permissions = [];
	private array $roles = [];

	public function __construct()
	{
		$this->init();
	}

	public function init()
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