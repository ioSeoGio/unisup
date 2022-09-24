<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\Discipline;

class DisciplineQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(Discipline::class);
    }
}
