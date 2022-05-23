<?php

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\MethodicalWorkReportAuthor;

class MethodicalWorkReportAuthorQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(MethodicalWorkReportAuthor::class);
    }
}
