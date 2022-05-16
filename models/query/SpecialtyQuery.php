<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\Specialty;

class SpecialtyQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(Specialty::class);
    }
}
