<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\Faculty;

class FacultyQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(Faculty::class);
    }
}
