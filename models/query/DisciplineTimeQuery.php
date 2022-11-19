<?php declare(strict_types=1);

namespace models\query;

use models\DisciplineTime;
use seog\db\ActiveQueryAdapter;

class DisciplineTimeQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(DisciplineTime::class);
    }
}
