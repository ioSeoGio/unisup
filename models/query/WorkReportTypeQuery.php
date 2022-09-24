<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\WorkReportType;

class WorkReportTypeQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(WorkReportType::class);
    }
}
