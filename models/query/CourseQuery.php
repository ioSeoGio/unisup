<?php

namespace models\query;

use models\Course;

class CourseQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(Course::class);
    }
}
