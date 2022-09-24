<?php declare(strict_types=1);

namespace models\query;

use seog\db\ActiveQueryAdapter;
use models\Journal;

class JournalQuery extends ActiveQueryAdapter
{
    public function __construct()
    {
        parent::__construct(Journal::class);
    }
}
