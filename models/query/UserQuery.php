<?php

namespace models\query;

use models\User;
use seog\db\ActiveQueryAdapter;

class UserQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(User::class);
    }
}
