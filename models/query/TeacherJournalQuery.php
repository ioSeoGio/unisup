<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\TeacherJournal;

class TeacherJournalQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(TeacherJournal::class);
    }
}
