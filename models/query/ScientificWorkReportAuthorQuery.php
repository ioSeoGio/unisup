<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\ScientificWorkReportAuthor;

class ScientificWorkReportAuthorQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(ScientificWorkReportAuthor::class);
    }
}
