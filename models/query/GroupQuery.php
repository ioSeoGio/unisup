<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\Group;

class GroupQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(Group::class);
    }
}
