<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\AcademicTitle;

class AcademicTitleQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(AcademicTitle::class);
    }
}
