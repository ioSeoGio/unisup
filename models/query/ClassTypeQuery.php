<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\ClassType;

class ClassTypeQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(ClassType::class);
    }
}
