<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\MethodicalWorkReport;

class MethodicalWorkReportQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(MethodicalWorkReport::class);
    }
}
