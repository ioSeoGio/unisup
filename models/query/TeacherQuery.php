<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\Teacher;

class TeacherQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(Teacher::class);
    }
}
