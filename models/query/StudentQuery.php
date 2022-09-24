<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\Student;

class StudentQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(Student::class);
    }
}
