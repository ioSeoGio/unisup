<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\JournalRecord;

class JournalRecordQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(JournalRecord::class);
    }
}
