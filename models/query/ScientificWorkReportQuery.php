<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\ScientificWorkReport;

class ScientificWorkReportQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(ScientificWorkReport::class);
    }
}
