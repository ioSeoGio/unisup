<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\TeacherPost;

class TeacherPostQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(TeacherPost::class);
    }
}
