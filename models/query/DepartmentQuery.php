<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\Department;

class DepartmentQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(Department::class);
    }
}
