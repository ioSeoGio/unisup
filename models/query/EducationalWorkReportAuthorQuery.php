<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\EducationalWorkReportAuthor;

class EducationalWorkReportAuthorQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(EducationalWorkReportAuthor::class);
    }
}
