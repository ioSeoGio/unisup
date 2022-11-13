<?php declare(strict_types=1);

namespace models\query;

use models\TeacherRate;
use seog\db\ActiveQueryAdapter;

class TeacherRateQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(TeacherRate::class);
    }
}
