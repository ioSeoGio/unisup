<?php declare(strict_types=1);

namespace models\query;

use models\TeacherPreference;
use seog\db\ActiveQueryAdapter;

class TeacherPreferenceQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(TeacherPreference::class);
    }
}
