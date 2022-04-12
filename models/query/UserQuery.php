<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\User;

class UserQuery extends ActiveQueryAdapter
{
	public function __construct()
	{
		parent::__construct(User::class);
	}
}