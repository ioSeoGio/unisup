<?php declare(strict_types=1);

namespace models\query;

use models\Course;
use seog\db\ActiveQueryAdapter;

class CourseQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(Course::class);
    }
}
