<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\TeacherPreference;

class TeacherPreferenceQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(TeacherPreference::class);
    }
}
