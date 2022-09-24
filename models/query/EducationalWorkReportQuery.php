<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\EducationalWorkReport;

class EducationalWorkReportQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(EducationalWorkReport::class);
    }
}
